<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Broadcast::routes(['middleware' => 'auth:api']);

Route::group(['middleware' => 'auth:api'], function(){
	Route::get('rooms', 'API\CreativeRoomController@showRoom');
	Route::post('storemessage', 'API\MessageController@storeMessage');
	Route::get('getmessages', 'API\MessagePaginationController@messagePagination');
	Route::get('previewfiles', 'API\CreativeRoomController@previewFiles');
	Route::get('chatroomfiles', 'API\MessageController@filesOnChatRoom');
	Route::get('previewroom', 'API\CreativeRoomController@roomInfo');
	Route::post('editroom', 'API\CreativeRoomController@updateRoom');
	Route::post('createroom', 'API\CreativeRoomController@createRoom');
	Route::post('endpoint', 'API\BroadcastController@apiEndpoint');
});