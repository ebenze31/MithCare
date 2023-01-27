<?php

use App\Tambon;
use Illuminate\Support\Facades\Route;


//Route for all providers login
Route::get('login/line','Auth\LoginController@redirectToLine');
Route::get('login/line/callback','Auth\LoginController@handleLineCallback');

//End Route providers login

Route::get('/', function () {
    return view('welcome');
});

Route::get('/privacy_policy', function () {
    return view('privacy_policy');
});


Route::get('/terms_of_service', function () {
    return view('terms_of_service');
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

Route::get('/profile/{id}/register', 'ProfileController@register')->name('profile_register');

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


// health_check /////////
Route::resource('health_check', 'Health_checkController');

// Game /////////
Route::resource('game', 'GameController');
