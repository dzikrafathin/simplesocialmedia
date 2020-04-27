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


Route::post('/register','API\UserController@store');
Route::post('/login','API\UserController@login');
Route::get('/login','API\UserController@infoLogin');

Route::get('/user','API\UserController@index');
Route::put('/user','API\UserController@update');
Route::delete('/user','API\UserController@destroy');
Route::get('/user/like','API\LikeController@indexUserLike');
Route::get('/user/komentar','API\KomentarController@indexUserKomentar');
Route::get('/user/{user}','API\UserController@show');
Route::get('/user/{user}/media','API\MediaController@indexMediaUser');
Route::get('/user/{user}/postingan','API\PostinganController@indexPostinganUser');


Route::get('/postingan','API\PostinganController@index');
Route::post('/postingan','API\PostinganController@store');
Route::get('/postingan/{postingan}','API\PostinganController@show');
Route::put('/postingan/{postingan}','API\PostinganController@update');
Route::delete('/postingan/{postingan}','API\PostinganController@destroy');
Route::get('/postingan/{postingan}/like','API\LikeController@indexPostinganLike');
Route::post('/postingan/{postingan}/like','API\LikeController@like');
Route::delete('/postingan/{postingan}/like','API\LikeController@unlike');
Route::get('/postingan/{postingan}/komentar','API\KomentarController@indexPostinganKomentar');
Route::post('/postingan/{postingan}/komentar','API\KomentarController@komentarPostingan');
Route::get('/postingan/{postingan}/media','API\MediaController@index');
Route::post('/postingan/{postingan}/media','API\MediaController@store');
Route::put('/komentar/{komentar}','API\KomentarController@perbaruiKomentar');
Route::delete('/komentar/{komentar}','API\KomentarController@hapusKomentar');
Route::delete('/media/{media}','API\MediaController@destroy');
*/

Route::post('login','API\UserController@login');

Route::apiResource('user','API\UserController');
Route::apiResource('user.postingan','API\UserPostinganController')->only(['index', 'store']);
Route::apiResource('user.media','API\UserMediaController')->only(['index']);
Route::apiResource('user.like','API\UserLikeController')->only(['index']);
Route::apiResource('user.komentar','API\UserKomentarController')->only(['index']);

Route::apiResource('postingan','API\PostinganController')->except(['store']);
Route::apiResource('postingan.like','API\PostinganLikeController')->only(['index', 'store', 'destroy'])->shallow();
Route::apiResource('postingan.media','API\PostinganMediaController')->only(['index','store', 'destroy'])->shallow();
Route::apiResource('postingan.komentar','API\PostinganKomentarController')->except(['show'])->shallow();
