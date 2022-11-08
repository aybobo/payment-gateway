<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentGatewayController;
use App\Http\Controllers\PaymentMethodController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/dashboard', function () {
//     return view('welcome');
// });

Route::view('/', 'auth.login')->name('index')->middleware('guest');
Auth::routes(['verify' => true]);
Route::redirect('/home', '/payment-methods')->name('home');

Route::get('/payment-gateways', [PaymentGatewayController::class, 'index'])->name('index.payment.gateway');
Route::post('/payment-gateway', [PaymentGatewayController::class, 'store'])->name('post.payment.gateway');
Route::get('/payment-gateway/{id}', [PaymentGatewayController::class, 'show'])->name('get.payment.gateway');
Route::put('/payment-gateway/{id}', [PaymentGatewayController::class, 'update'])->name('update.payment.gateway');
Route::delete('/payment-gateway/{id}', [PaymentGatewayController::class, 'destroy'])->name('delete.payment.gateway');

Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('index.payment.methods');
Route::post('/payment-method', [PaymentMethodController::class, 'store'])->name('post.payment.method');
Route::get('/payment-method/{id}', [PaymentMethodController::class, 'show'])->name('get.payment.method');
Route::put('/payment-method/{id}', [PaymentMethodController::class, 'update'])->name('update.payment.method');
Route::delete('/payment-method/{id}', [PaymentMethodController::class, 'destroy'])->name('delete.payment.method');


Route::fallback(function () {
    return view('default');
});