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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::post('/lineapi', 'API\LineApiController@store');

// ใช้เรียกที่อยู่
Route::get('/provinces', 'API\TambonController@getProvinces');
Route::get('/amphoes', 'API\TambonController@getAmphoes');
Route::get('/tambons', 'API\TambonController@getTambons');
Route::get('/zipcodes', 'API\TambonController@getZipcodes');

Route::get('/get_data_appoint/{appoint_id}', 'AppointController@get_data_appoint');

// ดึงข้อมูลผู้ป่วยจาก DB: member_of_rooms -> appoint.index.blade
Route::get('/member_of_this_room/{room_id}', 'AppointController@get_data_member_of_this_room');

// นับจำนวนคลิ๊ก หน้า Game
Route::get('/game', 'API\GameController@update_Click');

// หาห้องจากการค้นหา หน้าขอเข้าร่วมห้อง
Route::get('/find_room', 'RoomController@search_find_room');

// รับ request caregiver(คนที่ดูแลผู้ป่วย)
Route::get('/caretaker_of_room', 'API\API_CaretakerControllerController@getCaretaker');

// เช็ค Password ห้องว่าตรงใน db หรือไม่
Route::get('/check_password_of_room', 'RoomController@password_of_room');


//========================
//  Ask_for_Help API
//========================

// sos by phone
Route::get('/sos_phone', 'API\API_Ask_for_helpController@get_sos_by_phone');
// sos by btn
Route::get('/sos_btn', 'API\API_Ask_for_helpController@get_sos_by_btn');

// ดึงข้อมูล user มาใช้
Route::get('/ask_user_info/{user_id}','ProfileController@location_map_user');
// update ข้อมูล user ลง db
Route::get('/update_info_sos/','API\API_Ask_for_helpController@update_info_sos');

// หาจังหวัด
Route::get('/select_province','API\LocationController@show_location_P');
Route::get('/select_amphoe/{province}','API\LocationController@show_location_A');
Route::get('/select_tambon/{province}/{amphoe}','API\LocationController@show_location_T');
Route::get('/select_lat_lng/{province}/{amphoe}/{tambon}','API\LocationController@show_location_latlng');
Route::get('/select_lat_lng_province/{province}','API\LocationController@show_location_latlng_province');
Route::get('/select_lat_lng_amphoe/{province}/{amphoe}','API\LocationController@show_location_latlng_amphoe');

