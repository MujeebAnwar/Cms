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


Auth::routes();

Route::get('/admin',['middleware'=>'admin',function(){
    return view('admin.index');
}])->name('admin');

Route::group(['middleware'=>'admin'],function (){

    Route::resource('admin/users','AdminUserController');
    Route::resource('admin/posts','AdminPostController');
    Route::resource('admin/categories','AdminCategoriesController');


});

Route::get('/home', 'HomeController@index')->name('home');
