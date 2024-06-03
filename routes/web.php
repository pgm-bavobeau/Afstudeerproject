<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MolliePaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::statamic('example', 'example-view', [
//    'title' => 'Example'
// ]);

Route::post('/payment/create', [
    MolliePaymentController::class, 'preparePayment'
])->name('payment.create');
Route::post('/webhooks/mollie', [
    MolliePaymentController::class, 'handleWebHookNotification'
]);
Route::statamic('/payment/success', 'success', [
    MolliePaymentController::class, 'paymentSuccess'
])->name('payment.success');
Route::get('/payment/cancel', [
    MolliePaymentController::class, 'paymentCancel'
])->name('payment.cancel');

