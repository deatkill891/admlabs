<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\CorreoController;
use App\Http\Controllers\PermissionController; // Asegúrate de que este 'use' esté
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- GRUPO DE RUTAS DE ADMINISTRACIÓN ---
    // Todas las rutas aquí dentro requerirán que el usuario tenga el rol 'Admin'
    Route::group(['middleware' => ['role:Admin']], function () {

        // --- RUTAS DE ADMINISTRACIÓN DE USUARIOS (Protegidas por permiso) ---
        Route::group(['middleware' => ['permission:administrar usuarios']], function () {
            Route::get('/usuarios', [UserController::class, 'index'])->name('admin.users.index');
            Route::post('/usuarios', [UserController::class, 'store'])->name('admin.users.store');
            Route::get('/usuarios/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
            Route::put('/usuarios/{user}', [UserController::class, 'update'])->name('admin.users.update');
            Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        });

        // --- RUTAS DE ADMINISTRACIÓN DE MATERIALES (Protegidas por permiso) ---
        Route::group(['middleware' => ['permission:administrar materiales']], function () {
            Route::get('/materiales', [MaterialController::class, 'index'])->name('admin.materials.index');
            Route::post('/materiales', [MaterialController::class, 'store'])->name('admin.materials.store');
            Route::get('/materiales/{material}/edit', [MaterialController::class, 'edit'])->name('admin.materials.edit');
            Route::put('/materiales/{material}', [MaterialController::class, 'update'])->name('admin.materials.update');
            Route::delete('/materiales/{material}', [MaterialController::class, 'destroy'])->name('admin.materials.destroy');
        });

        // --- RUTAS DE ADMINISTRACIÓN DE CORREOS (Protegidas por permiso) ---
        Route::group(['middleware' => ['permission:administrar correos']], function () {
            Route::get('/correos', [CorreoController::class, 'index'])->name('admin.mails.index');
            Route::post('/correos', [CorreoController::class, 'store'])->name('admin.mails.store');
            Route::get('/correos/{correo}/edit', [CorreoController::class, 'edit'])->name('admin.mails.edit');
            Route::put('/correos/{correo}', [CorreoController::class, 'update'])->name('admin.mails.update');
            Route::delete('/correos/{correo}', [CorreoController::class, 'destroy'])->name('admin.mails.destroy');
        });

        // --- RUTAS DE ADMINISTRACIÓN DE PERMISOS (Protegidas por permiso) ---
        Route::group(['middleware' => ['permission:administrar permisos']], function () {
            Route::get('/permisos', [PermissionController::class, 'index'])->name('admin.permissions.index');
            Route::post('/permisos', [PermissionController::class, 'store'])->name('admin.permissions.store');
            Route::get('/permisos/{permission}/edit', [PermissionController::class, 'edit'])->name('admin.permissions.edit');
            Route::put('/permisos/{permission}', [PermissionController::class, 'update'])->name('admin.permissions.update');
            Route::delete('/permisos/{permission}', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');
        });
    });
});

require __DIR__.'/auth.php';