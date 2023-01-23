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

Route::get('/provinces', 'API\TambonController@getProvinces');
Route::get('/amphoes', 'API\TambonController@getAmphoes');
Route::get('/tambons', 'API\TambonController@getTambons');
Route::get('/zipcodes', 'API\TambonController@getZipcodes');

Route::get('/get_data_appoint/{appoint_id}', 'AppointController@get_data_appoint');

Route::get('/game', 'API\GameController@update_Click');



// Route::get('/show_amphoes/{province}', 'API\TambonController@getAmphoes');
