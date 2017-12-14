<?php
use App\Mail\Prueba;

Route::get('/new', 'HomeController@new')->name('new');	

Auth::routes();
Route::group(['middleware' => 'auth'],function(){
Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/get', 'HomeController@getAll')->name('getAll');
	Route::post('/update', 'HomeController@changeState')->name('update');
	Route::post('/updatePrice', 'HomeController@updatePrice')->name('updatePrice');
	Route::get('/chat', 'ChatController@index')->name('chat');
	Route::post('/send', 'ChatController@send')->name('send');	
});
