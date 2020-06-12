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

//food routes
Route::resource('food', 'FoodController')->middleware('is_admin');

//auth route web
Auth::routes();

//home page
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//route for patients
Route::resource('user', 'UserController')->middleware('is_admin');

//admin route
Route::get('admin/home','HomeController@adminHome')->name('admin.home')->middleware('is_admin');

//report show
Route::get('/user/{user_id}/{report_id}', 'UserController@showReport')->middleware('is_admin');

//search bar food
Route::get('/searchfood', 'FoodController@searchFood')->middleware('is_admin');

//search bar user
Route::get('/searchuser', 'UserController@searchUser')->middleware('is_admin');

//data for graph
Route::get('/user/{user}', 'UserController@graphData')->middleware('is_admin');