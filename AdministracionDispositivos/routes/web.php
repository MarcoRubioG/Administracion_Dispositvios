<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceAssignmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Gestión de Usuarios
    Route::resource('usuarios', UserController::class);
    
    // Gestión de Dispositivos
    Route::resource('dispositivos', DeviceController::class);
    
    // Actualizar solo el estado del dispositivo
    Route::patch('dispositivos/{device}/estado', [DeviceController::class, 'updateEstado'])->name('dispositivos.updateEstado');
    
    // Gestión de Asignaciones
    Route::resource('asignaciones', DeviceAssignmentController::class);
    
    // Generar Carta Poder en PDF
    Route::get('asignaciones/{assignment}/carta-poder', [DeviceAssignmentController::class, 'generarCartaPoder'])->name('asignaciones.cartaPoder');
});

require __DIR__.'/auth.php';