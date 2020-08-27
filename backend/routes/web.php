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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->prefix('telegram')->namespace('Telegram')->name('telegram.')->group(function () {
   Route::get('/', 'DashBoardController@index')->name('index');
   Route::get('/setting', 'Setting\SettingController@index')->name('setting.index');
   Route::post('/setting/store', 'Setting\SettingController@store')->name('setting.store');

   Route::post('/setting/setwebhook', 'Setting\SettingController@setWebHook')->name('setting.setwebhook');
   Route::post('/setting/getwebhookinfo', 'Setting\SettingController@getWebHookInfo')->name('setting.getwebhookinfo');
});

Auth::routes();

Route::post(Telegram::getAccessToken(), function () {
    Telegram::comandsHandler(true);
});

Route::match(['get', 'post'], 'register', function() {
    Auth::logout();
    return redirect('/login');
})->name('register');



Route::get('/home', 'HomeController@index')->name('home');
