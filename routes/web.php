<?php

use App\Http\Controllers\DataTableController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckinController;

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





//Route::any('/',[CheckinController::class,'calculate'])->name('show');

Route::any('/',[CheckinController::class,'getUsersWithCheckins'])->name('show');
Route::any('/users',[CheckinController::class,'userscheck']);

//Route::get('/', [DataTableController::class,'index'])->name('users.index');

