<?php

use Illuminate\Support\Facades\Route;

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


// Route::get('/create', function () {
//     return view('foodLibrary.create');
// });

//foodLibrary route
Route::resource('foodLibrary', 'FoodLibraryController')->middleware('is_admin');
//auth route web
Auth::routes();
//home page
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//test 
Route::get('/patient/user', function (){
    return view('patient.show');
});

//route for patients
Route::resource('patient', 'PatientController')->middleware('is_admin');

//admin route
Route::get('admin/home','Homecontroller@adminHome')->name('admin.home')->middleware('is_admin');