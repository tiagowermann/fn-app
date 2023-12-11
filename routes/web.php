<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\Mails\AuthMailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/painel/login', [homeController::class, 'login'])->name('login');
Route::post('/painel/login', [homeController::class, 'loginAction']);
Route::get('/painel/singup', [homeController::class, 'singUp']);
Route::post('/painel/singup', [homeController::class, 'singUpAction']);
Route::get('/painel/logout', [homeController::class, 'logout']);

Route::get('/', [homeController::class, 'home'])->name('home');
Route::post('/painel/form/', [homeController::class, 'formAction']);
Route::get('/painel/editar', [homeController::class, 'Edit']);
Route::post('/painel/editar', [homeController::class, 'EditAction']);
Route::post('/painel/delete/', [homeController::class, 'deleteFn']);

Route::get('/painel/relatorio/mail', [AuthMailController::class, 'senRegisterMail']);
Route::get('/painel/relatorio/mail/{slug}', [AuthMailController::class, 'senEnvilOnMail']);

Route::get('/dashboard', [DashboardController::class ,'index'])->name('dashboard');
Route::post('/dashboard/form/user', [DashboardController::class ,'store']);


