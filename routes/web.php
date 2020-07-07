<?php

use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Food;
use App\User;

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
//welcome page
Route::get('/', function () {
    return view('welcome');
});

/*
    food routes for CRUD functions:
    1. index
    2. create
    3. store
    4. show
    5. edit
    6. update
    7. destroy
*/
Route::resource('food', 'FoodController')->middleware('is_admin');

/*
    routes for web authentication:
    1. login
    2. register
    3. reset password
*/
Auth::routes([
    'register' => true
    //set register to false for disable register function
]);

//home page
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

/*
    patients/users routes for CRUD functions:
    1. index
    2. create
    3. store
    4. show
    5. edit
    6. update
    7. destroy
*/
Route::resource('user', 'UserController')->middleware('is_admin');

//admin redirect after login route
Route::get('admin/home','HomeController@adminHome')->name('admin.home')->middleware('is_admin');

//show particular user report
Route::get('/user/{user_id}/{report_id}', 'UserController@showReport')->middleware('is_admin');

//search bar for food module
Route::get('/searchfood', 'FoodController@searchFood')->middleware('is_admin');

//search bar for user module
Route::get('/searchuser', 'UserController@searchUser')->middleware('is_admin');

//data for graph
Route::get('/user/{user}', 'UserController@graphData')->middleware('is_admin');