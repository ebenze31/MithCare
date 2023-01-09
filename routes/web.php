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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Profiles

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/{id}/edit', 'ProfileController@edit')->name('profile_edit');
Route::post('/profile/{id}', 'ProfileController@update')->name('profile_update');

////// ที่อยู่ ///////////
// Route::get('/profile/{id}/edit', function () {
//     $provinces = Tambon::select('province')->distinct()->get();
//     $amphoes = Tambon::select('amphoe')->distinct()->get();
//     $tambons = Tambon::select('tambon')->distinct()->get();
//     return view("profile/profile_form", compact('provinces','amphoes','tambons'));
// });

Route::resource('room', 'RoomController');

// Route::get('/room/{id}/edit', 'RoomController@edit')->name('room_edit');