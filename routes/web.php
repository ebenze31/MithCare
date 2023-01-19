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


 // ADMIN MithCare //////
// Route::middleware(['auth', 'role:isAdmin'])->group(function () {

    Route::get('room_admin', 'RoomController@room_admin_index')->name('room_admin');

// });
// END ADMIN MithCare



// Appoint /////////

// Route::get('appoint', 'AppointController@index')->name('appoint');
// Route::resource('appoint', 'AppointController');

Route::get('appoint', 'AppointController@index');
Route::post('appoint/edit', 'AppointController@update')->name('appoint_edit');
Route::post('appoint/{id}/create', 'AppointController@store')->name('appoint_store');
Route::delete('appoint/{id}', 'AppointController@destroy')->name('appoint_destroy');


// Member_of_Room /////////

Route::resource('member_of_room', 'Member_of_roomController');

// Ask_for_Help /////////

Route::resource('ask_for_help', 'Ask_for_helpController');

Route::resource('health_check', 'Health_checkController');