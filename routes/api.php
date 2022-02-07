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
// question routes
Route::get('/question','App\Http\Controllers\QuestionController@index');
Route::get('/question/{id}','App\Http\Controllers\QuestionController@show');


// AUTHENTICATED USERS ROUTES
Route::group(['middleware' => ['auth:sanctum']], function(){
    // auth routes
    Route::post('/logout','App\Http\Controllers\AuthController@logout');
    // question routes
    Route::post('/question','App\Http\Controllers\QuestionController@store');
    Route::post('/like_question','App\Http\Controllers\QuestionController@likeQuestion');
    Route::post('answer_question','App\Http\Controllers\AnswerController@store');
    Route::put('update_answer','App\Http\Controllers\AnswerController@update');
});

// ADMIN ROUTES
Route::group(['middleware' => ['auth:sanctum','check_admin']], function(){
    // question routes
    Route::put('/question/{id}','App\Http\Controllers\QuestionController@update');
    Route::delete('/question/{id}','App\Http\Controllers\QuestionController@destroy');
    Route::put('/approve_question','App\Http\Controllers\Admin\QuestionController@approveQuestion');
    Route::put('/decline_question','App\Http\Controllers\Admin\QuestionController@declineQuestion');
});