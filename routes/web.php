<?php


//Route::get('/{all?}', function () {
//    return view('welcome');
//})->where('all', '.*')->middleware('generate_instagram_auth_link');

//Route::get('/test/{access_token?}','InstagramController@fetchInstaData');

Route::get('/', function () {
    return view('welcome');
})->middleware('generate_instagram_auth_link');

Route::post('send-email','UsersMediaController@sendEmail');
Route::get('/login-redirect','UsersController@InstagramLoginRedirect');
Route::get('/home','UsersController@fetchInstagramImages');
Route::get('/logout','UsersController@logout');

Route::get('/{user_name}','UsersMediaController@mediaByUserName');
Route::get('/{user_name}/{image_id}','UsersMediaController@accessSingleImage')->where('image_id', '[0-9]+');
