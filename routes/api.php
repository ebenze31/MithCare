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
// ดึงข้อมูลสมาชิกในบ้านทั้งหมดจาก DB: member_of_rooms -> room.edit_member.blade
Route::get('/member_for_edit_status/{room_id}', 'RoomController@get_data_member_of_this_room');
// ดึงข้อมูลสมาชิกในบ้านทั้งหมดจาก DB: member_of_rooms -> room.edit_member.blade ใช้สำหรับเลือก checkbox ตามข้อมูลในฐานข้อมูล
Route::get('/member_for_checkbox/{room_id}/{user_id}/{status}', 'API\API_RoomController@get_data_member');
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
Route::post('/sos_btn', 'API\API_Ask_for_helpController@get_sos_by_btn');

// ดึงข้อมูล user มาใช้
Route::get('/ask_user_info/{user_id}','ProfileController@location_map_user');
// update ข้อมูล user ลง db
Route::get('/update_info_sos','API\API_Ask_for_helpController@update_info_sos');
// เพิ่มภาพถ่าย จาก การช่วยเหลือเสร็จสิ้น ใน line
Route::post('/submit_add_photo', 'API\API_Ask_for_helpController@submit_add_photo');
// ให้คะแนนหน่วยงาน จาก User ใน line
Route::get('/submit_score/{sos_map_id}/{score_1}/{score_2}/{total_score}/{comment_help}', 'API\API_Ask_for_helpController@submit_score');
// หาจังหวัด
Route::get('/select_province','API\LocationController@show_location_P');
Route::get('/select_amphoe/{province}','API\LocationController@show_location_A');
Route::get('/select_tambon/{province}/{amphoe}','API\LocationController@show_location_T');
Route::get('/select_lat_lng/{province}/{amphoe}/{tambon}','API\LocationController@show_location_latlng');
Route::get('/select_lat_lng_province/{province}','API\LocationController@show_location_latlng_province');
Route::get('/select_lat_lng_amphoe/{province}/{amphoe}','API\LocationController@show_location_latlng_amphoe');

//========================
//  partner
//========================
Route::get('/submit_show_homepage/{partner_id}/{input_show_homepage}', 'API\PartnersController@submit_show_homepage');

Route::get('/marker_current/{name_partner}', 'API\PartnersController@marker_current');


// หาห้องจากการค้นหา หน้าขอเข้าร่วมห้อง
Route::get('/video_call', 'AgoraVideoController@token');
Route::get('/getUserRemote', 'AgoraVideoController@getUserRemote');

//========================
// Before Video Call
//========================
// ทำการ upadate สถานะ ว่ามีคนอยู่ในห้องกี่คน ทุก 5 วิ --> room_rtc.index.blade
Route::get('/urlCheckPeople', 'AgoraVideoController@checkPeopleInRoom');

//ส่ง ข้อมูล videoCall ไปเก็บในฐานข้อมูล
Route::get('/getStatRoom', 'RoomRTCController@getStatRoom');
Route::get('/getMember_form_id', 'RoomRTCController@getMember_form_id');
//========================
//  videoCall
//========================

//ส่ง ข้อมูล videoCall ไปเก็บในฐานข้อมูล
Route::get('/urlStatsVideo', 'AgoraVideoController@store');
Route::get('/urlMemberVideo', 'AgoraVideoController@member_in_room');

//เมื่อ leaveChannel ส่งข้อมูล videoCall ไปเก็บในฐานข้อมูล
Route::get('/leaveChannel', 'AgoraVideoController@leaveChannel');
Route::get('/userLeave', 'AgoraVideoController@userLeave');

//หาข้อมูล localPlayer videoCall
Route::get('/localPlayerData', 'AgoraVideoController@localPlayerData');



