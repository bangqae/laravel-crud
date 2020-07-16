<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route Frontend
Route::get('/', 'SiteController@home');
Route::get('/register', 'SiteController@register');
Route::post('/postregister', 'SiteController@postregister');

//Route Login
Route::get('/login','AuthController@login')->name('login');
Route::any('/postlogin','AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

//Route Admin, Siswa
Route::middleware(['auth','checkRole:admin,siswa'])->group(function () {
    Route::get('/dashboard','DashboardController@index');
});

//Route Admin
Route::middleware(['auth','checkRole:admin'])->group(function () {
    Route::get('/siswa','SiswaController@index');
    Route::post('/siswa/create','SiswaController@create');
    Route::get('/siswa/{siswa}/edit','SiswaController@edit');
    Route::post('/siswa/{siswa}/update','SiswaController@update');
    Route::get('/siswa/{siswa}/delete','SiswaController@delete');
    Route::get('/siswa/{siswa}/profile','SiswaController@profile');
    Route::post('/siswa/{siswa}/addnilai','SiswaController@addnilai');
    Route::get('/siswa/{siswa}/{idmapel}/deletenilai','SiswaController@deletenilai');
    Route::get('/siswa/exportexcel', 'SiswaController@exportExcel');
    Route::get('/siswa/exportpdf', 'SiswaController@exportPdf');
    Route::get('/siswa/siswapdf', 'SiswaController@siswapdf');
    Route::get('/guru/{guru}/profile','GuruController@profile');
});
