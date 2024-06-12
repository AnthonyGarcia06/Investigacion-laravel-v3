<?php



// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Ruta raíz que redirige a la lista de tareas
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Rutas de recursos para el controlador de tareas
Route::resource('tasks', TaskController::class);

// routes/web.php
Route::get('/users/active', [TaskController::class, 'listActiveUsers'])->name('users.active');







