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
    return view('front.main');
});



Route::get('/program/current', function () {
    return view('front.program.current');
});
Route::get('/program/end', function () {
    return view('front.program.end');
});
Route::get('/program/all', function () {
    return view('front.program.all');
});
Route::get('/program/detail/{id}', function () {
    return view('front.program.detail');
});

Route::get('/board/notice', function () {
    return view('front.board.notice');
});
Route::get('/board/pairing', function () {
    return view('front.board.pairing');
});
Route::get('/board/feedback', function () {
    return view('front.board.feedback');
});


//admin
Route::get('/_admin/login', 'Admin\LoginController@login');
Route::post('/_admin/login', 'Admin\LoginController@loginAction');
Route::get('/_admin/logout', function () {
	Session::flush();
    return Redirect::to('_admin/login');
});
Route::get('/_admin/main', 'Admin\AdminController@main');
Route::get('/_admin', 'Admin\AdminController@main');


Route::get('/_admin/program/config', 'Admin\ProgramController@config');

Route::get('/_admin/program/list', 'Admin\ProgramController@list');
Route::get('/_admin/program/list/{page}', 'Admin\ProgramController@list');
Route::post('/_admin/program/regist', 'Admin\ProgramController@registAction');
Route::get('/_admin/program/regist', 'Admin\ProgramController@regist');
Route::get('/_admin/program/detail/{id}', 'Admin\ProgramController@detail');
Route::post('/_admin/program/update', 'Admin\ProgramController@updateAction');

Route::get('/_admin/program/delete/{id}', 'Admin\ProgramController@delete');
Route::get('/_admin/programSection/delete/{id}', 'Admin\ProgramController@secDelete');


/** Common FileUpload */
Route::post('/api/fileUpload', 'FileController@upload');

/**배너 */
Route::get('/_admin/banner', 'Admin\BannerController@index');
Route::post('/_admin/banner/update', 'Admin\BannerController@update');


/**공지사항 */
Route::get('/_admin/notice', 'Admin\NoticeController@index');
Route::get('/_admin/notice/reg', 'Admin\NoticeController@reg');
Route::post('/_admin/notice/reg', 'Admin\NoticeController@regAction');
Route::get('/_admin/notice/{page}', 'Admin\NoticeController@index');
Route::get('/_admin/notice/detail/{id}', 'Admin\NoticeController@detail');
Route::post('/_admin/notice/update/{id}', 'Admin\NoticeController@updateAction');
Route::get('/_admin/notice/delete/{id}', 'Admin\NoticeController@deleteAction');
/** 편성표 */
Route::get('/_admin/pairing', 'Admin\PairingController@index');
Route::post('/_admin/pairing/update', 'Admin\PairingController@update');

/** 시청자의견 */
Route::get('/_admin/feedback', 'Admin\FeedbackController@index');
Route::get('/_admin/feedback/{page}', 'Admin\FeedbackController@index');
Route::get('/_admin/feedback/detail/{id}', 'Admin\FeedbackController@detail');

/** 관리자 계정 관리 */
Route::get('/_admin/account', 'Admin\AccountController@list');
Route::get('/_admin/account/reg', 'Admin\AccountController@reg');
Route::post('/_admin/account/reg', 'Admin\AccountController@regAction');
Route::get('/_admin/account/{page}', 'Admin\AccountController@list');//

Route::get('/_admin/account/detail/{id}', 'Admin\AccountController@detail');
Route::post('/_admin/account/update/{id}', 'Admin\AccountController@updateAction');
Route::get('/_admin/account/delete/{id}', 'Admin\AccountController@deleteAction');