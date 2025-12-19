<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Registercontroller;
use App\Http\Controllers\Kategoricontroller;
use App\Http\Controllers\AdminController;

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

// hOME ROUTE
Route::middleware(['auth'])->group(function(){
    //user
    Route::get('/user', [UsersController::class, 'index'])->name('usershome');
    Route::get('/user/panen', [UsersController::class, 'panen'])->name('panen');
    Route::post('/user/panen', [UsersController::class, 'input_panen'])->name('input_panen');
    //admin
    Route::get('/admin', [AdminController::class, 'index'])->name('adminhome');
    Route::delete('/admnin/user/{id}', [AdminController::class, 'destroy'])->name('hapus');
    route::put('/admnin/user/{id}', [AdminController::class, 'update'])->name('update');
    Route::post('/admnin/user', [AdminController::class, 'tambah_user'])->name('tambah_user');
    //logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    //chart
    Route::get('/grafik', function () {
        return view('front.grafik');
    })->name('grafik');
});

//lOGIN ROUTE
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// REGISTER ROUTE
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// FORGOOT PASSWORD ROUTE
Route::get('/forgootpassword', function () {
    return view('forgootpassword');
})->name('forgootpassword');


//input kategori
Route::get('/kategori',[KategoriController::class, 'index'])->name('kategori');
Route::post('/kategori',[KategoriController::class, 'input_data'])->name('input_kategori');

