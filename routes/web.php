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

    ############## PERMISSOES ###############
    Route::get('/permissoes', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.view');
    Route::get('/permissoes/cadastro', [App\Http\Controllers\PermissionController::class, 'create'])->name('permissions.create');
    Route::get('/permissoes/{id}', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissoes', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
    Route::put('/permissoes/{id}', [App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissoes', [App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.delete');


    ############## PERFIS (ROLES) ###############
    Route::get('/perfis', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.view');
    Route::get('/perfis/cadastro', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
    Route::get('/perfis/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/perfis', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::put('/perfis', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::delete('/perfis', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.delete');

    ############## USUARIOS ###############
     Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('users.view');
     Route::get('/usuarios/cadastro', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
     Route::get('/usuarios/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
     Route::post('/usuarios', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
     Route::put('/usuarios', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
     Route::delete('/usuarios', [App\Http\Controllers\UserController::class, 'update'])->name('users.delete');

});

