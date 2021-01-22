<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// My API routes
// Create
Route::post('crud', 'CRUDController@create');
// Get
Route::get('crud', 'CRUDController@index');
// Update
Route::put('crud/{id}', 'CRUDController@update');
// Delete
Route::delete('crud/{id}', 'CRUDController@delete');