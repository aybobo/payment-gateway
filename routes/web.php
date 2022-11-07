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

Route::get('/gateways', [PaymentGatewayController::class, 'index']);
Route::get('gateways/{id}', [PaymentGatewayController::class, 'show']);
Route::post('gateways', [PaymentGatewayController::class, 'store']);
Route::put('gateways/{id}', [PaymentGatewayController::class, 'update']);
Route::delete('gateways/{id}', [PaymentGatewayController::class, 'delete']);

Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('index.payment.methods');
Route::post('/payment-method', [PaymentMethodController::class, 'store'])->name('post.payment.method');
Route::get('/payment-method/{id}', [PaymentMethodController::class, 'show'])->name('get.payment.method');
Route::put('/payment-method/{id}', [PaymentMethodController::class, 'update'])->name('update.payment.method');
Route::delete('/payment-method/{id}', [PaymentMethodController::class, 'destroy'])->name('delete.payment.method');


Route::fallback(function () {
    return view('default');
});