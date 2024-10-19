<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SingleChargeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     $user = auth()->user();
//     return view('dashboard',[
//         'intent' => $user->createSetupIntent()
//     ]);
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('single-charge', [SingleChargeController::class, 'singleCharge'])->name('single.charge');
    Route::get('/home', function () {
        // $user = auth()->user();
        return view('home');
    })->name('home');
    Route::get('plans', [SubscriptionController::class, 'index'])->name('plans');
    Route::get('plans/create', [SubscriptionController::class, 'create'])->name('plan.create');
    Route::post('plans/store', [SubscriptionController::class, 'store'])->name('plan.store');
    Route::get('plans/checkout/{planId}', [SubscriptionController::class,'checkout'])->name('plan.checkout');
    Route::post('plans/process', [SubscriptionController::class,'processSubscription'])->name('plan.process');
    Route::get('subscription', [SubscriptionController::class,'allSubscription'])->name('subscription');
    Route::post('subscription/cancel', [SubscriptionController::class,'cancelSubscription'])->name('cancel');
    Route::post('subscription/resume', [SubscriptionController::class,'resumeSubscription'])->name('resume');

});

require __DIR__.'/auth.php';
