<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
class SingleChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function singleCharge(Request $request)
    {

        // dd($request);
        $amount = $request->amount;
        $amount = $amount * 100;
        // Stripe::setApiKey(env('STRIPE_SECRET'));
        // $paymentIntent = PaymentIntent::create([
        //     'amount' => $amount,
        //     'currency' => 'usd',
        //     'automatic_payment_methods' => [
        //         'enabled' => true,
        //         'allow_redirects' => 'never',
        //     ],
        // ]);
        // dd($paymentIntent);
        $paymentMethod = $request->payment_method;
        $user = auth()->user();
        $user->createOrGetStripeCustomer();
        $paymentMethod = $user->addPaymentMethod($paymentMethod);
        // dd($paymentMethod->id);
        $user->charge($amount,$paymentMethod->id);
        // dd($user->charge($amount,$paymentMethod->id));
        return to_route('home');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
