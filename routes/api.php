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
    Route::post('login', 'Auth\AuthController@login')->name('login');           // api for login
    Route::post('register', 'Auth\AuthController@register');                    // api for register (patient only)
    Route::group([
      'middleware' => 'auth:api'                                                // middleware for other function to access system via api
    ], function() {
        Route::get('logout', 'Auth\AuthController@logout');                     // api for logout
        Route::get('user', 'Auth\AuthController@user');                         // api for user detail
        Route::get('foodlist', 'api\ApiController@foodList');                   // api for food library list
        Route::post('userdiet', 'api\ApiController@userDiet');                  // api for user daily intake (input)
        Route::post('patientreport', 'api\ApiController@patientReport');        // api for HCP enter patient dialysis report
        Route::get('userdietlist', 'api\ApiController@userDietList');           // api for user show daily food intake
        Route::post('deletedietlist', 'api\ApiController@deleteUserDiet');      // api for user delete food from daily intake
        Route::get('userdietpercent', 'api\ApiController@userDietPercent');     // api for user show percentage of daily nutrition intake
    });
});
