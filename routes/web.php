<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestEmocionalController;
use App\Http\Controllers\EjercicioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecordatorioController;
use App\Http\Controllers\RecursoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

// Rutas solo para visitantes SIN sesión iniciada
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/registro', function () {
        return view('registro');
    })->name('registro');
    Route::post('/registro', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas: solo accesibles si el usuario inició sesión
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/estado-animo', [DashboardController::class, 'guardarEstado'])->name('dashboard.estado-animo');

    Route::get('/ejercicios', [EjercicioController::class, 'index'])->name('ejercicios');
    Route::get('/ejercicios/{ejercicio}', [EjercicioController::class, 'show'])->name('ejercicios.detalle');
    Route::post('/ejercicios/{ejercicio}/completar', [EjercicioController::class, 'completar'])->name('ejercicios.completar');

    Route::get('/recursos', [RecursoController::class, 'index'])->name('recursos');
    Route::get('/recursos/{recurso}', [RecursoController::class, 'show'])->name('recursos.detalle');

    Route::get('/recordatorios', [RecordatorioController::class, 'index'])->name('recordatorios');
    Route::post('/recordatorios', [RecordatorioController::class, 'store'])->name('recordatorios.guardar');
    Route::post('/recordatorios/{recordatorio}/alternar', [RecordatorioController::class, 'alternar'])->name('recordatorios.alternar');
    Route::delete('/recordatorios/{recordatorio}', [RecordatorioController::class, 'destroy'])->name('recordatorios.eliminar');

    Route::get('/test-emocional', function () {
        return view('test-emocional');
    })->name('test-emocional');
    Route::post('/test-emocional', [TestEmocionalController::class, 'guardar'])->name('test-emocional.guardar');
    Route::get('/test-emocional/resultado/{test}', [TestEmocionalController::class, 'resultado'])->name('test-emocional.resultado');

    Route::get('/perfil', function () {
        return view('perfil', [
            'ejerciciosRealizados' => \App\Models\EjercicioRegistro::where('user_id', auth()->id())->count(),
            'testsCompletados' => \App\Models\TestEmocional::where('user_id', auth()->id())->count(),
        ]);
    })->name('perfil');

    Route::put('/perfil', [ProfileController::class, 'update'])->name('perfil.actualizar');
});

// Vista de Error 404
Route::get('/404', function () {
    return view('404');
})->name('error.404');