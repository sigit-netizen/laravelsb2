<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Registercontroller;
use App\Http\Controllers\Kategoricontroller;

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
    //crud
    Route::get('/', [UsersController::class, 'Tampil_data'])->name('home');
    Route::delete('/user/{id}', [UsersController::class, 'destroy'])->name('hapus');
    route::put('/user/{id}', [UsersController::class, 'update'])->name('update');
    Route::post('/user', [UsersController::class, 'tambah_user'])->name('tambah_user');
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

