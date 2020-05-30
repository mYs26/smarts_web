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
    // $user = \App\User::first();
    // $report= \App\Report::all();

    // $user->reports()->sync([
    //     1 => [
    //         'doctor_name' => 'Amir Farhan'
    //     ]
    // ]);

    // // dd($food);
});


// Route::get('/create', function () {
//     return view('foodLibrary.create');
// });

//food routes
Route::resource('food', 'FoodController')->middleware('is_admin');

//foodLibrary route
// Route::resource('foodLibrary', 'FoodLibraryController')->middleware('is_admin');

//auth route web
Auth::routes();

//home page
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//test 
Route::get('/patient/user', function (){
    return view('patient.show');
});

//route for patients
Route::resource('user', 'UserController')->middleware('is_admin');

//admin route
Route::get('admin/home','Homecontroller@adminHome')->name('admin.home')->middleware('is_admin');