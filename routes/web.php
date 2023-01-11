<?php

use App\Tambon;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Calendar_test', function () {
    return view('Calendar_test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Profiles

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/{id}/edit', 'ProfileController@edit')->name('profile_edit');
Route::post('/profile/{id}', 'ProfileController@update')->name('profile_update');

//// My_Room /////////

Route::resource('room', 'RoomController');
Route::get('room_join', 'RoomController@room_join');

 /// Find_Room //////

Route::get('room_find', 'RoomController@room_find_index')->name('room_find');
Route::get('room_find/{id}/edti', 'RoomController@room_edit')->name('room_find_edit');

 // Admin Room //////

Route::get('room_admin', 'RoomController@room_admin_index')->name('room_admin');

// Appoint /////////

Route::get('appoint', 'AppointController@index')->name('appoint');
Route::get('appoint/{id}/edit', 'AppointController@edit')->name('appoint_edit');




// Route::resource('appoint', 'AppointController');