<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\CreatePaymentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('credits', [CreditController::class, 'index'])->name('credits');
Route::post('credits', [CreditController::class, 'store'])->name('create.credit');
Route::put('credits', CreatePaymentController::class)->name('create.payment');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
