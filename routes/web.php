<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SupervisorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::middleware('supervisor:supervisor')->group(function(){
    Route::get('supervisor/login',[SupervisorController::class,'loginForm']);
    Route::post('supervisor/login',[SupervisorController::class,'store'])->name('supervisor.login');
});


Route::middleware(['auth:sanctum,supervisor',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/supervisor/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('auth:supervisor');
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::middleware('admin:admin')->group(function(){
    Route::get('admin/login',[AdminController::class,'loginForm']);
    Route::post('admin/login',[AdminController::class,'store'])->name('admin.login');
});


Route::middleware(['auth:sanctum,admin',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('auth:admin');
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
