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
Route::post('login-admin', 'AuthController@loginAdmin'); //Login Admin
Route::post('register-admin', 'AuthController@registerAdmin'); //Register Admin
Route::post('register-siswa', 'AuthController@registerSiswa'); //Login Siswa
Route::post('login-siswa', 'AuthController@loginSiswa'); //Register Siswa
Route::get('cekAkun', 'AuthController@cekAkun')->middleware('auth:admin-api,siswa-api'); //Cek Akun

// Route::get('user', 'AuthController@getUser')->middleware('auth:admin-api, siswa-api'); //Get User

Route::resource('siswa', 'SiswaController')->middleware('auth:admin-api'); //CRUD Siswa

Route::middleware('auth:siswa-api,admin-api')->get('/user', function (Request $request) {
    return $request->user();
});

// EMAIL
Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify'); // Make sure to keep this as your route name
Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
