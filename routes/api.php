<?php

use App\Http\Controllers\fnController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/ping', function(Request $request){
    return ['pong'=>true];
});

//router login/registro
Route::get('/login', [userController::class, 'login']);
Route::post('/registe', [userController::class, 'registe']);

//router get user 
Route::get('/user', [userController::class, 'users']);

//router tho finaces

Route::get('/painel', [fnController::class, 'getFnAllUse']);



