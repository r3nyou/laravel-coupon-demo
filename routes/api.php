<?php

use App\Http\Controllers\CouponController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('example/{id}', function ($id) {
    return ['id' => $id];
});

Route::get('/coupon/{code}', [CouponController::class, 'show']);

Route::post('/coupon', [CouponController::class, 'create']);

