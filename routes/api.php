<?php

use App\Http\Controllers\AuthController;
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

Route::prefix( 'v1')->group( function(){


Route::get('/test', function(){

    return response()->json(['msg' => 'Hello world']);

});

Route::post('/login', 'AuthController@login');

Route::post('/register', 'AuthController@register');
Route::post('/verify-email', 'AuthController@verifyEmail');
Route::post('/forgot-password', 'AuthController@forgotPassword');
Route::post('/reset-password', 'AuthController@resetPassword');


Route::prefix('me')->group(function() {

    Route::get('', 'MeController@index');
    //atualizar info do user
    Route::put('', 'MeController@update');
   

});

Route::prefix('todos')->group(function(){

     Route::get('', 'TodoController@index');
     Route::get('{todo}', 'TodoController@show');
     Route::post('', 'TodoController@store');
     Route::put('{todo}', 'TodoController@update');
     Route::delete('{todo}', 'TodoController@destroy');
     Route::post('{todo}/tasks', 'TodoController@addTask');

});

Route::prefix('todo-tasks')->group(function(){
    Route::put('{todoTask}', 'TodoTaskController@update');
    Route::delete('{todoTask}', 'TodoTaskController@destroy');

});




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


});


