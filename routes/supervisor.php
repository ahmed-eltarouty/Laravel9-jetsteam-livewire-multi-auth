<?php

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

