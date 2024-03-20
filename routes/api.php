<?php

use App\Http\Controllers\FastSpringController;
use App\Http\Controllers\UserController;
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


Route::group(['controller' => UserController::class], function () {
    Route::get('/user', 'me')->name('user.me');
});



Route::group(['controller' => FastSpringController::class], function () {
    Route::group(['prefix' => 'fastspring'], function () {
        // Route::get('/account/{id}', 'getAccount')->name('fastspring.account');
        // Route::get('/management-url/{id}', 'getManagementUrl')->name('fastspring.management-url');
        // Route::get('/subscription/{id}', 'getSubscription')->name('fastspring.subscription');
        Route::post('/account/update/{accountId}', 'updateAccount')->name('fastspring.account.update');
    });
});
