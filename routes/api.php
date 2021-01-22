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
Route::post('crud/create', 'CRUDController@create');
// Get
Route::get('crud', 'CRUDController@index');
// Update
Route::put('crud/update/{id}', 'CRUDController@update');
// Delete
Route::delete('crud/delete/{id}', 'CRUDController@delete');