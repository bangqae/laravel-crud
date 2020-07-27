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
    // Siswa
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@create');
    // Meh
    // Route::get('/siswa/{siswa}/edit', 'SiswaController@edit');

    // Better, uses as route
    Route::get('/siswa/{siswa}/edit', [
        'uses' => 'SiswaController@edit',
        'as' => 'siswa.edit'
    ]);

    Route::post('/siswa/{siswa}/update', 'SiswaController@update');
    Route::get('/siswa/{siswa}/delete', 'SiswaController@delete');
    Route::get('/siswa/{siswa}/profile', 'SiswaController@profile');
    Route::post('/siswa/{siswa}/addnilai', 'SiswaController@addnilai');
    Route::get('/siswa/{siswa}/{idmapel}/deletenilai', 'SiswaController@deletenilai');
    Route::get('/siswa/exportexcel', 'SiswaController@exportExcel');
    Route::get('/siswa/exportpdf', 'SiswaController@exportPdf');
    Route::get('/siswa/siswapdf', 'SiswaController@siswapdf');
    // Guru
    Route::get('/guru/{guru}/profile', 'GuruController@profile');
    // Posts
    Route::get('/posts', 'PostController@index')->name('posts.index');
    Route::get('/post/add', [ // Yang tampil di url
        'uses' => 'PostController@add',
        'as' => 'posts.add' // Yang sebenarnya diakses
    ]);
    Route::post('/post/create', [
        'uses' => 'PostController@create',
        'as' => 'posts.create'
    ]);

    Route::get('/post/{post}/edit', [
        'uses' => 'PostController@edit',
        'as' => 'posts.edit'
    ]);

    Route::post('/post/{post}/update', [
        'uses' => 'PostController@update',
        'as' => 'posts.update'
    ]);

    Route::get('/post/{post}/delete', [
        'uses' => 'PostController@delete',
        'as' => 'posts.delete'
    ]);
});

// Route Filemanager, prevent unauthorized upload
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//  Ajax yajra datatable
Route::get('getdatasiswa', [
    'uses' => 'SiswaController@getdatasiswa',
    'as' => 'ajax.get.data.siswa',
]);

// Route View Post, paling bawah agar yang lain tidak dibaca sebagai slug
Route::get('/{slug}', [
    'uses' => 'SiteController@singlepost',
    'as' => 'sites.singlepost'
]);
