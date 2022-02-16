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
    Route::post('/logout','AuthController@logout');

    Route::post('/save_blog','SaveController@saveBlog');
    Route::post('/detach_blog','SaveController@unsaveBlog');
    Route::get('/mySavedBlogs','SaveController@mySavedBlogs');

    // question routes
    Route::get('/question','QuestionController@index');
    Route::get('/question/{id}','QuestionController@show');
    Route::post('/question','QuestionController@store');
    Route::put('/question/{id}','QuestionController@update');
    Route::delete('/question/{id}','QuestionController@destroy');

    Route::get('/my_questions','QuestionController@myQuestions');
    Route::get('/search_questions','QuestionController@searchQuestion');
    
    Route::post('/like_question','QuestionController@likeQuestion');
   

    //answer routes
    Route::post('/answer_question','AnswerController@store');
    Route::put('/update_answer/{id}','AnswerController@update');
    Route::delete('/delete_answer/{id}','AnswerController@destroy');

    Route::post('/like_answer','AnswerController@likeAnswer');
    Route::post('/dislike_answer','AnswerController@dislikeAnswer');

    Route::get('/answer_replies/{id}','AnswerController@answerReplies');

    // reply Routes
    Route::post('/reply','ReplyController@store');
    Route::put('/reply/{id}','ReplyController@update');
    Route::delete('/reply/{id}','ReplyController@destroy');

    Route::post('/like_reply','ReplyController@likeReply');
    Route::post('/dislike_reply','ReplyController@dislikeReply');


    // category public
    Route::get('/category','Admin\CategoryController@index');
    Route::get('/category_questions/{id}','Admin\CategoryController@categoryQuestions');

    // blog category endpoints
    Route::get('/blogCategory','BlogcategoryController@index');
    Route::get('/blogCategory_blogs/{id}','BlogcategoryController@categoryBlogs');
    
    // Tag public
    Route::get('/tag','Admin\TagController@index');
    Route::get('/tag_questions/{id}','Admin\TagController@tagQuestions');

    // blog endpoints
    Route::get('/blog','BlogController@index');
    Route::get('/blog/{id}','BlogController@show');
    Route::get('/categoryBlogs/{id}','BlogController@categoryBlogs');
    Route::post('/like_blog','BlogController@likeBlog');


});

// ADMIN ROUTES
// Route::group(['middleware' => ['auth:sanctum','check_admin']], function(){
    // question routes
    Route::put('/approve_question','Admin\QuestionController@approveQuestion');
    Route::put('/decline_question','Admin\QuestionController@declineQuestion');


    

   
// });

















Route::get('/getCustomers','CustomerController@getCustomers');
Route::get('/disableCustomers/{id}','CustomerController@disableCustomer');
Route::get('/enableCustomers/{id}','CustomerController@enableCustomer');
Route::post('/createCustomer','CustomerController@createCustomer')->name('api.createCustomer');

Route::post('/importCustomer','CustomerController@importCustomer')->name('api.importCustomer');

Route::get('batch/{id}','CustomerController@batchStatus');

// route for the ajax pagination on all customers table
Route::get('/api/customers','CustomerController@allCustomerApi')->name('api.customers');

