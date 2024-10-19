<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Plan;
use Stripe\Stripe;
use App\Models\Plans;
use App\Models\CentralPlan;
use Laravel\Cashier\Subscription;
use App\Models\Subscriptions;
use Carbon\Carbon;
class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $basic = Plans::where('name','Basic')->first();
        // $professional = Plans::where('name','Professional')->first();
        // $enterprise = Plans::where('name','Enterprise')->first();
        $plan = CentralPlan::all();
        return view('plans.plans',compact('plan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // dd(auth()->user()->id);
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try{
            $plan=Plan::create([
                'amount' => $request->amount*100,
                'currency' => 'usd',
                'interval' => $request->billing_period,
                'interval_count' => $request->interval_count,
                'product' => [
                    'name' => $request->name
                ]
            ]);
            // Plans::create([
            //     'plan_id' => $plan->id,
            //     'name' => $request->name,
            //     'price' => $request->amount,
            //     'billing_method' => $plan->interval,
            //     'currency' => $plan->currency,
            //     'interval_count' => $plan->interval_count
            // ]);
            CentralPlan::create([
                'stripe_plan_id' => $plan->id,
                'name' => $request->name,
                'price' => $request->amount,
                'bill_period' => $plan->interval,
                'currency' => $plan->currency,
                'period' => $plan->interval_count,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);
            
        }catch(Exception $ex){
            dd($ex->getMessage());
        }
        return redirect('plans');
    }

    /**
     * Display the specified resource.
     */
    public function checkout($planId)
    {
        $plan = CentralPlan::where('stripe_plan_id',$planId)->first();
        if(!$plan){
            return back()->withErrors([
                'message' => 'Unable to locate the plan'
            ]);
        }
        return view('plans.checkout',[
            'plan' => $plan,
            'intent' => auth()->user()->createSetupIntent(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function processSubscription(Request $request)
    {
        // dd($request);
        $user = auth()->user();
        // dd($user->subscription());
        $user->createOrGetStripeCustomer();
        $paymentMethod = null;
        $paymentMethod = $request->payment_method;
        if($paymentMethod != null){
            $paymentMethod = $user->addPaymentMethod($paymentMethod);
        }
        $plan = $request->plan_id;
        $sub_ends_at= null;
        try{
            $sub = $user->newSubscription(
                'default', $plan
            )->create($paymentMethod != null ? $paymentMethod->id:'');
            if($request->billing_period == 'month'){
                $sub_ends_at = Carbon::now()->addMonths((int)$request->period)->toDateString();
            }elseif($request->billing_period == 'year'){
                $sub_ends_at = Carbon::now()->addYear((int)$request->period)->toDateString();
            }else{
                $sub_ends_at = Carbon::now()->addWeeks((int)$request->period)->toDateString();
            }
            // dd($lastDayOfThreeMonths);
            $subscription = Subscriptions::where('id',$sub->id)->update(
                [
                    'subscription_name' => 'Subscription Premium '.$request->period.''.$request->billing_period,
                    "plan_id" => $request->id,
                    'expired_date' => $sub_ends_at,
                    'activated_date' => $sub->created_at,
                    "created_by" => $user->id,
                    "updated_by" => $user->id,
                ]
            );
            // dd($subscription);
        }catch(Exception $ex){
            return back()->withErrors([
                'error' => 'Unable to create subscription due to this issue'.$ex->getMessage()
            ]);
        }
        $request->session()->flash('alert-success','You are subscribed to this plan');
        return redirect('subscription');
    }

    /**
     * Update the specified resource in storage.
     */
    public function allSubscription()
    {
        $subscriptions = Subscription::join('central_plan','subscriptions.stripe_price','=','central_plan.stripe_plan_id')->select('subscriptions.*','central_plan.name as plan_name','central_plan.price')->where('user_id',auth()->id())->get();
        // dd($subscriptions);
        // $user = auth()->user();
        // $sub = $user->subscription();
        return view('subscription.index',compact('subscriptions'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancelSubscription(Request $request)
    {
        $subscriptionName = $request->subscriptionName;
        $user = auth()->user();
        // dd($user->subscription());
        $subscription = $user->subscription($subscriptionName);
        if ($subscription) {
            $subscription->cancel();
            $request->session()->flash('alert-success','You have canceled subscription');
            return redirect('subscription'); // This will work once the subscription is not null
        } else {
            $request->session()->flash('alert-failed','Subscription with the given name does not exist.');
            return redirect('subscription');
        }
    }
    public function resumeSubscription(Request $request)
    {
        $subscriptionName = $request->subscriptionName;
        $user = auth()->user();
        // dd($user->subscription());
        $subscription = $user->subscription($subscriptionName);
        if ($subscription) {
            $subscription->resume();
            $request->session()->flash('alert-success','You have resume subscription');
            return redirect('subscription'); // This will work once the subscription is not null
        } else {
            $request->session()->flash('alert-failed','Subscription with the given name does not exist.');
            return redirect('subscription');
        }
    }
}
