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


Route::group(['namespace' => 'ToDoListControllers'], function () {
    Route::get('/','ToDoListController@goToHome');
});



Route::group(['prefix'=> LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){
    Route::group(['namespace'=>'ToDoListControllers','prefix' => 'user'], function () {
        Route::post('/addtask', 'ToDoListController@create')->name('create');
        Route::get('/','ToDoListController@index')->name('home');
        Route::get('/edit/{id}','ToDoListController@edit')->name('edit');
        Route::post('/update/{id}','ToDoListController@update')->name('update');
        Route::get('/delete/{id}','ToDoListController@delete')->name('delete');
    });

});
