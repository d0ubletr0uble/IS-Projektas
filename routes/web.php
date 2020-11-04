<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/admin/block', function () {
    return view('admin_block');
});

Route::get('/admin/unblock', function () {
    return view('admin_unblock');
});

Route::get('/admin/statistics', function () {
    return view('admin_statistics');
});

Route::get('/admin/logincnt', function () {
    return view('admin_logincnt');
});

Route::get('/admin/sentmesg', function () {
    return view('admin_sentmesg');
});

// don't touch this function
Route::get('/git-pull', function () {
    exec('sudo git pull origin code');
    return redirect('/');
});