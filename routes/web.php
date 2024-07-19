<?php

use App\Http\Controllers\TasksController;
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

Route::prefix('task')->name('task.')->group(function (){

    Route::get('create',[TasksController::class,'createView'])
        ->name('create.show');

    Route::post('create',[TasksController::class,'create'])
        ->name('create');

    Route::get('update/{task}',[TasksController::class,'updateView'])
        ->name('update.show');

    Route::post('update/{task}',[TasksController::class,'update'])
        ->name('update');

    Route::get('delete/{task}',[TasksController::class,'delete'])
        ->name('delete');

});

Route::get('/{project?}',[TasksController::class,'show'])->name('home');
