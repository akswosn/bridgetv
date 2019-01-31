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

//frontend
Route::get('/', function () {
    return view('front.home');
});
Route::post('/', function () {
    return view('front.home');
});
Route::get('/program', function () {
    return view('front.program');
});
Route::get('/program/{id}', function () {
    return view('front.program_detail');
});
Route::get('/board', function () {
    return view('front.board');
});
Route::get('/board/{id}', function () {
    return view('front.board_detail');
});

//admin
Route::get('/_admin/login', 'Admin\LoginController@login');
Route::post('/_admin/login', 'Admin\LoginController@loginAction');

Route::get('/_admin/main', 'Admin\AdminController@main');
Route::get('/_admin', 'Admin\AdminController@main');

Route::get('/_admin/banner', function () {
    return view('admin.banner');
});

Route::get('/_admin/notice', function () {
    return view('admin.notice');
});
Route::get('/_admin/notice/{id}', function () {
    return view('admin.noticeDetail');
});
Route::get('/_admin/pairing', function () {
    return view('admin.pairing');
});
Route::get('/_admin/program', function () {
    return view('admin.program');
});
Route::get('/_admin/progran/detail/{id}', function () {
    return view('admin.programDetail');
});
Route::get('/_admin/config/program', function () {
    return view('admin.configProgram');
});


Route::get('/_admin/feedback', 'Admin\FeedbackController@index');
Route::get('/_admin/feedback/{page}', 'Admin\FeedbackController@index');
Route::get('/_admin/feedback/{id}', 'Admin\FeedbackController@detail');

/** 관리자 계정 관리 */
Route::get('/_admin/account', 'Admin\AccountController@list');
Route::get('/_admin/account/reg', 'Admin\AccountController@reg');
Route::post('/_admin/account/reg', 'Admin\AccountController@regAction');
Route::get('/_admin/account/{page}', 'Admin\AccountController@list');//

Route::get('/_admin/account/detail/{id}', 'Admin\AccountController@detail');
Route::post('/_admin/account/update/{id}', 'Admin\AccountController@updateAction');
Route::get('/_admin/account/delete/{id}', 'Admin\AccountController@deleteAction');