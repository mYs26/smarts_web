<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Auth\AuthController@login')->name('login');
    Route::post('register', 'Auth\AuthController@register');
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'Auth\AuthController@logout');
        Route::get('user', 'Auth\AuthController@user');
        Route::get('foodlist', 'api\ApiController@foodList');
        Route::post('userdiet', 'api\ApiController@userDiet');
        Route::post('patientreport', 'api\ApiController@patientReport');
        Route::get('userdietlist', 'api\ApiController@userDietList');
        Route::post('deletedietlist', 'api\ApiController@deleteUserDiet');
        Route::get('userdietpercent', 'api\ApiController@userDietPercent');
    });
});
