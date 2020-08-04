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

use Illuminate\Mail\Markdown;

// Kirim Email Test
// Route::get('/kirimemail', function() {
//     \Mail::raw('halo siswa baru', function ($message) {
//         $message->to('qaedinahri.16@gmail.com', 'Qaedi');
//         $message->subject('Pendaftaran Siswa');
//     });
// });

// Route Frontend
// Route::get('/', 'SiteController@home');
Route::get('/', [
    'uses' => 'SiteController@home',
    'as' => 'home'
]);
Route::get('/register', 'SiteController@register');
Route::post('/postregister', 'SiteController@postregister');

// Route Login
Route::get('/login','AuthController@login')->name('login');
Route::any('/postlogin','AuthController@postlogin');
Route::get('/logout', [
    'uses' => 'AuthController@logout',
    'as' => 'logout'
]);

// Route Admin, Siswa
Route::middleware(['auth','checkRole:admin,siswa'])->group(function () {
    Route::get('/dashboard','DashboardController@index')->name('dashboard');
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
    Route::get('/siswa/{siswa}/profile', 'SiswaController@profile')->name('siswa.profile');
    Route::post('/siswa/{siswa}/addnilai', 'SiswaController@addnilai');
    Route::get('/siswa/{siswa}/{idmapel}/deletenilai', 'SiswaController@deletenilai');
    // Import
    Route::post('/siswa/import', 'SiswaController@importExcel')->name('siswa.import');
    // Export
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
    //  Ajax yajra datatable
    Route::get('getdatasiswa', [
        'uses' => 'SiswaController@getdatasiswa',
        'as' => 'ajax.get.data.siswa',
    ]);
});

//Route Siswa
Route::middleware(['auth','checkRole:siswa'])->group(function () {
    Route::get('profilsaya','SiswaController@profilsaya')->name('siswa.profilsaya');
});

// Route Filemanager, prevent unauthorized upload
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// Preview email pendaftaran
Route::get('mail', function () {
    $markdown = new Markdown(view(), config('mail.markdown'));
    return $markdown->render('emails.sites.pendaftaran');
});

// Route View Post, paling bawah agar yang lain tidak dibaca sebagai slug
Route::get('/{slug}', [
    'uses' => 'SiteController@singlepost',
    'as' => 'sites.singlepost'
]);
