<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::prefix('admin.')->middleware(['access.control.list'])->group(function () {
//     Route::resource('/users', App\Http\Controllers\UserController::class);
// });

 Route::middleware(['access.control.list'])->group(function(){
    ############## USUARIOS ###############
     Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('users.view');
     Route::get('/usuarios/cadastro', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
     Route::get('/usuarios/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
     Route::post('/usuarios', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
     Route::put('/usuarios', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
     Route::delete('/usuarios', [App\Http\Controllers\UserController::class, 'update'])->name('users.delete');
});

