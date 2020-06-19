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

/*
Route::get('user/profile','API\UserController@infoLogin');
Route::post('user/login','API\UserController@login');
Route::post('user/logout','API\UserController@logout');
Route::post('user/register','API\UserController@store');
Route::post('user/profile','API\UserController@update');

Route::apiResource('user','API\UserController')->except(['store','update']);
Route::apiResource('user.postingan','API\UserPostinganController')->only(['index']);
Route::apiResource('user.media','API\UserMediaController')->only(['index']);
Route::apiResource('user.like','API\UserLikeController')->only(['index']);
Route::apiResource('user.komentar','API\UserKomentarController')->only(['index']);

Route::apiResource('postingan','API\PostinganController');
Route::apiResource('postingan.like','API\PostinganLikeController')->only(['index', 'store', 'destroy'])->shallow();
Route::apiResource('postingan.media','API\PostinganMediaController')->only(['index','store', 'destroy'])->shallow();
Route::apiResource('postingan.komentar','API\PostinganKomentarController')->except(['show'])->shallow();
*/

// V2

Route::get('user/profil','V2\UserController@profil');
Route::post('user/login','V2\UserController@login');
Route::post('user/logout','V2\UserController@logout');
Route::post('user/daftar','V2\UserController@store');
Route::post('user/profil','V2\UserController@update');

Route::apiResource('postingan','V2\PostinganController');
Route::apiResource('postingan.komentar','V2\PostinganKomentarController')->shallow();

Route::get('postingan/{postingan}/like','V2\PostinganLikeController@index');
Route::post('postingan/{postingan}/like','V2\PostinganLikeController@like');
Route::delete('postingan/{postingan}/like','V2\PostinganLikeController@unlike');

// Buat Testing

/*
Route::get('test/indexpostingan','TesterController@testIndexPostingan');
Route::get('test/{postingan}/indexkomentar','TesterController@testIndexKomentar');
Route::get('test/{postingan}/indexlike','TesterController@testIndexLike');
Route::get('test/{user}/userpostingan','TesterController@testIndexUserPostingan');
Route::get('test/{user}/userlike','TesterController@testIndexUserLike');
Route::get('test/{user}/userkomentar','TesterController@testIndexUserKomentar');
*/