<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// PUBLIC ROUTES
// auth routes
Route::post('/register','App\Http\Controllers\AuthController@register');
Route::post('/login','App\Http\Controllers\AuthController@login');


// AUTHENTICATED USERS ROUTES
Route::group(['middleware' => ['auth:sanctum']], function(){
    // auth routes
    Route::post('/logout','App\Http\Controllers\AuthController@logout');

    // question routes
    Route::get('/question','App\Http\Controllers\QuestionController@index');
    Route::get('/question/{id}','App\Http\Controllers\QuestionController@show');
    Route::post('/question','App\Http\Controllers\QuestionController@store');
    Route::put('/question/{id}','App\Http\Controllers\QuestionController@update');
    Route::delete('/question/{id}','App\Http\Controllers\QuestionController@destroy');

    Route::get('/my_questions','App\Http\Controllers\QuestionController@myQuestions');
    Route::get('/search_questions','App\Http\Controllers\QuestionController@searchQuestion');
    
    Route::post('/like_question','App\Http\Controllers\QuestionController@likeQuestion');
   

    //answer routes
    Route::post('/answer_question','App\Http\Controllers\AnswerController@store');
    Route::put('/update_answer/{id}','App\Http\Controllers\AnswerController@update');
    Route::delete('/delete_answer/{id}','App\Http\Controllers\AnswerController@destroy');

    Route::post('/like_answer','App\Http\Controllers\AnswerController@likeAnswer');
    Route::post('/dislike_answer','App\Http\Controllers\AnswerController@dislikeAnswer');

    Route::get('/answer_replies/{id}','App\Http\Controllers\AnswerController@answerReplies');

    // reply Routes
    Route::post('/reply','App\Http\Controllers\ReplyController@store');
    Route::put('/reply/{id}','App\Http\Controllers\ReplyController@update');
    Route::delete('/reply/{id}','App\Http\Controllers\ReplyController@destroy');

    Route::post('/like_reply','App\Http\Controllers\ReplyController@likeReply');
    Route::post('/dislike_reply','App\Http\Controllers\ReplyController@dislikeReply');


    // category public
    Route::get('/category','App\Http\Controllers\Admin\CategoryController@index');
    Route::get('/category_questions/{id}','App\Http\Controllers\Admin\CategoryController@categoryQuestions');
    // Tag public
    Route::get('/tag','App\Http\Controllers\Admin\TagController@index');
    Route::get('/tag_questions/{id}','App\Http\Controllers\Admin\TagController@tagQuestions');

    // blog endpoints
    Route::get('/blog','App\Http\Controllers\BlogController@index');
    Route::get('/blog/{id}','App\Http\Controllers\BlogController@show');
    Route::get('/categoryBlogs/{id}','App\Http\Controllers\BlogController@categoryBlogs');
    Route::post('/like_blog','App\Http\Controllers\BlogController@likeBlog');


});

// ADMIN ROUTES
Route::group(['middleware' => ['auth:sanctum','check_admin']], function(){
    // question routes
    Route::put('/approve_question','App\Http\Controllers\Admin\QuestionController@approveQuestion');
    Route::put('/decline_question','App\Http\Controllers\Admin\QuestionController@declineQuestion');
    
    // category CRUD
    Route::post('/category','App\Http\Controllers\Admin\CategoryController@store');
    Route::put('/category/{id}','App\Http\Controllers\Admin\CategoryController@update');
    Route::delete('/category/{id}','App\Http\Controllers\Admin\CategoryController@destroy');

    // tag CRUD
    Route::post('/tag','App\Http\Controllers\Admin\TagController@store');
    Route::put('/tag/{id}','App\Http\Controllers\Admin\TagController@update');
    Route::delete('/tag/{id}','App\Http\Controllers\Admin\TagController@destroy');

    // blog endpoints
    Route::post('/blog','App\Http\Controllers\BlogController@store');
    Route::put('/blog/{id}','App\Http\Controllers\BlogController@update');
    Route::delete('/blog/{id}','App\Http\Controllers\BlogController@destroy');
});