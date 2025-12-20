<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //admin
    Route::get('/adminhome', [AdminController::class, 'index'])->name('adminhome');
    Route::delete('/user/{id}', [AdminController::class, 'destroy'])->name('user.destroy');
    Route::put('/user/{id}', [AdminController::class, 'update'])->name('user.update');
    Route::post('/tambah_user', [AdminController::class, 'tambah_user'])->name('tambah_user');

    //user
    Route::get('/usershome', [UsersController::class, 'index'])->name('usershome');
    Route::get('/panen', [UsersController::class, 'panen'])->name('grafik');
    Route::post('/input_panen', [UsersController::class, 'input_panen'])->name('input_panen');

});



require __DIR__.'/auth.php';
