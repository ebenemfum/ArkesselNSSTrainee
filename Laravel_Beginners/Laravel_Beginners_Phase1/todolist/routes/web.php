<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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




Route::get('/', [TaskController::class, 'index'])->name('tasks');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::put('/tasks/{task}/completed', [TaskController::class, 'markAsCompleted'])->name('tasks.completed');
Route::put('/tasks/{task}/incomplete', [TaskController::class, 'markAsIncomplete'])->name('tasks.incomplete');
