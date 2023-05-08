<?php

use App\Tambon;
use Illuminate\Support\Facades\Route;


//========================
//  ROUTE PROVIDERS LOGIN
//========================

Route::resource('member_of_room', 'Member_of_roomController');
Route::get('login/line','Auth\LoginController@redirectToLine');
Route::get('login/line/callback','Auth\LoginController@handleLineCallback');

//===========================
// END ROUTE PROVIDERS LOGIN
//===========================

Route::get('/', function () {
    return view('welcome');
});

Route::get('/privacy_policy', function () {
    return view('privacy_policy');
});

Route::get('/terms_of_service', function () {
    return view('terms_of_service');
});


Auth::routes();

// เช็คล็อคอิน
Route::get('room_check_login', 'RoomController@check_login');
Route::get('ask_for_help_check_login', 'Ask_for_helpController@check_login');
Route::get('profile_check_login', 'ProfileController@check_login');
Route::get('health_check_check_login', 'Health_checkController@check_login');
Route::get('game_check_login', 'GameController@check_login');
Route::get('/log_in_ask_for_help_add_photo/{id_sos_map}', 'Ask_for_helpController@log_in_ask_for_help_add_photo');
Route::get('/log_in_ask_for_help_rate_help/{id_sos_map}', 'Ask_for_helpController@log_in_ask_for_help_rate_help');

Route::get('test', 'TestController@test');
Route::get('test_doc', 'TestController@test_doc');
// Route::get('test_room', 'TestController@sentLineTest');

//========================
//     Video_Call Test
//========================
Route::get('video_call', 'TestController@video_call');
// Route::get('/video_call', function () {
//     return view('/test/video_call');
// });
// Route::get('/test_video_2', function () {
//     return view('/test/test_video_2');
// });




//========================
//     ADMIN MithCare
//========================

Route::middleware(['auth', 'role:isAdmin'])->group(function () {

    Route::resource('partner', 'PartnerController');

});

//========================
//   ADMIN PARTNER
//========================
Route::middleware(['auth', 'role:isAdmin,partner'])->group(function () {

    Route::get('/sos_partner', 'PartnerController@view_sos');
    Route::get('room_admin', 'RoomController@room_admin_index')->name('room_admin');

});


Route::middleware(['auth'])->group(function () {

    //========================
    //     PROFILE
    //========================

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/profile/{id}/edit', 'ProfileController@edit')->name('profile_edit');
    Route::post('/profile/{id}', 'ProfileController@update')->name('profile_update');

    Route::get('/profile/{id}/register', 'ProfileController@register')->name('profile_register');

    //========================
    //       ROOM
    //========================

    Route::resource('room', 'RoomController');

    /// Find_Room //////

    Route::post('room_find', 'RoomController@room_find_index')->name('room_find');
    Route::post('room_join', 'RoomController@room_join')->name('room_join');
    Route::patch('member_of_room_edit/{id}', 'RoomController@member_of_room_edit')->name('member_of_room_edit');
    // Route::get('room_find/{id}/edit', 'RoomController@room_edit')->name('room_find_edit');

    /// Room_RTC //////
    Route::get('room_lobby', 'RoomRTCController@index')->name('room_lobby');

    Route::get('/room_call/{room_id}/{user_id}', 'AgoraVideoController@index');
    Route::post('/agora/token', 'AgoraVideoController@token');
    Route::post('/agora/call-user', 'AgoraVideoController@callUser');



    //========================
    //     MEMBER_OF_ROOM
    //========================

    Route::resource('member_of_room', 'Member_of_roomController');

    //========================
    //     Appoint
    //========================

    // Route::get('appoint', 'AppointController@index')->name('appoint');
    // Route::resource('appoint', 'AppointController');
    Route::get('appoint', 'AppointController@index');
    Route::post('appoint/edit', 'AppointController@update')->name('appoint_edit');
    Route::post('appoint/{id}/create', 'AppointController@store')->name('appoint_store');
    Route::delete('appoint/{id}', 'AppointController@destroy')->name('appoint_destroy');

    //========================
    //     ASK_FOR_HELP
    //========================

    Route::resource('ask_for_help', 'Ask_for_helpController');
    Route::get('/test_sos', 'Ask_for_helpController@sos_to_line');
    Route::get('/ask_for_help/add_photo/{id_sos_map}', 'Ask_for_helpController@ask_for_help_add_photo');
    Route::get('/ask_for_help/rate_help/{id_sos_map}', 'Ask_for_helpController@rate_help');
    //========================
    //     HEALTH_CHECK
    //========================
    Route::resource('health_check', 'Health_checkController');

    //========================
    //     GAME
    //========================
    Route::resource('game', 'GameController');

});

    //=============================
    // ASK_FOR_HELP No Middleware
    //=============================
Route::get('/sos_thank_submit_score/{user_id}', 'Ask_for_helpController@sos_thank_submit_score');





// /////////////////
// หน้าที่ไม่ได้ใช้จริง //
///////////////////

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/Calendar_test', function () {
    return view('Calendar_test');
});

/////////////////////////
// สิ้นสุด หน้าที่ไม่ได้ใช้จริง //
////////////////////////


Route::resource('group_line', 'Group_lineController');
