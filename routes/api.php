<?php

use Illuminate\Http\Request;



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// PUBLIC ROUTES
// auth routes
Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');


// AUTHENTICATED USERS ROUTES
Route::group(['middleware' => ['auth:sanctum']], function(){
    // auth routes
    Route::post('/logout','App\Http\Controllers\AuthController@logout');

    // question routes
    Route::get('/question','App\Http\Controllers\QuestionController@index');
    Route::get('/question/{id}','App\Http\Controllers\QuestionController@show');
    Route::post('/question','QuestionController@store');
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

    // blog category endpoints
    Route::get('/blogCategory','App\Http\Controllers\BlogcategoryController@index');
    Route::get('/blogCategory_blogs/{id}','App\Http\Controllers\BlogcategoryController@categoryBlogs');
    
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
    Route::put('/approve_question','Admin\QuestionController@approveQuestion');
    Route::put('/decline_question','Admin\QuestionController@declineQuestion');
    
    // category CRUD
    Route::post('/category','Admin\CategoryController@store');
    Route::put('/category/{id}','Admin\CategoryController@update');
    Route::delete('/category/{id}','Admin\CategoryController@destroy');

    // blog category CRUD
    Route::post('/blogCategory','App\Http\Controllers\BlogcategoryController@store');
    Route::put('/blogCategory/{id}','App\Http\Controllers\BlogcategoryController@update');
    Route::delete('/blogCategory/{id}','App\Http\Controllers\BlogcategoryController@destroy');

    // tag CRUD
    Route::post('/tag','Admin\TagController@store');
    Route::put('/tag/{id}','Admin\TagController@update');
    Route::delete('/tag/{id}','Admin\TagController@destroy');

    // blog endpoints
    Route::post('/blog','App\Http\Controllers\BlogController@store');
    Route::put('/blog/{id}','App\Http\Controllers\BlogController@update');
    Route::delete('/blog/{id}','App\Http\Controllers\BlogController@destroy');
});

















Route::get('/getCustomers','CustomerController@getCustomers');
Route::get('/disableCustomers/{id}','CustomerController@disableCustomer');
Route::get('/enableCustomers/{id}','CustomerController@enableCustomer');
Route::post('/createCustomer','CustomerController@createCustomer')->name('api.createCustomer');

Route::post('/importCustomer','CustomerController@importCustomer')->name('api.importCustomer');

Route::get('batch/{id}','CustomerController@batchStatus');

// route for the ajax pagination on all customers table
Route::get('/api/customers','CustomerController@allCustomerApi')->name('api.customers');

