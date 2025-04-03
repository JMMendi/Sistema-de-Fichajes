<?php

use App\Http\Middleware\isAdminMiddleware;
use App\Livewire\InformeMensual;
use App\Livewire\Inicio;
use App\Livewire\ShowFichas;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/inicio', Inicio::class)->name('inicio');
    Route::get('/informe', InformeMensual::class)->name('informe')->middleware(isAdminMiddleware::class);
    Route::get('/show-fichas', ShowFichas::class)->name('listado')->middleware(isAdminMiddleware::class);
});

