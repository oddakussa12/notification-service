<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::get('/getCustomers','CustomerController@getCustomers');
Route::get('/disableCustomers/{id}','CustomerController@disableCustomer');
Route::get('/enableCustomers/{id}','CustomerController@enableCustomer');
Route::post('/createCustomer','CustomerController@createCustomer')->name('api.createCustomer');
Route::post('/importCustomer','CustomerController@importCustomer')->name('api.importCustomer');

Route::get('batch/{id}','CustomerController@batchStatus');