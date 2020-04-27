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



Auth::routes();


/**
 * Route For Public Post
 */

Route::get('/post/{post}','AdminPostController@post')->name('post.home');
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

/**
 * @Admin Route With MiddleWare
 */
Route::group(['middleware'=>'admin'],function (){


    Route::get('/admin','AdminController@index')->name('admin');

    Route::resource('admin/users','AdminUserController');
    Route::resource('admin/posts','AdminPostController');
    Route::resource('admin/categories','AdminCategoriesController');
    Route::post('delete/media','AdminPhotoController@deleteMedia')->name('delete.media');
    Route::get('admin/media/upload','AdminPhotoController@upload')->name('admin.media.upload');
    Route::resource('admin/media','AdminPhotoController');
    Route::resource('admin/comments','PostCommentsController');
    Route::resource('admin/comment/replies','CommentRepliesController');
    Route::get('comment/replies/{comment}','CommentRepliesController@singleCommentReplies')->name('single.comment.reply');
    Route::get('replies/comment/{reply}','PostCommentsController@singleReplyComment')->name('single.reply.comment');


});

Route::group(['middleware'=>'auth'],function(){

    Route::post('comment/reply','CommentRepliesController@commentReply')->name('comment.reply');

});


//Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//    \UniSharp\LaravelFilemanager\Lfm::routes();
//});

