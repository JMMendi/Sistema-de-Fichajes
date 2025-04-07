<?php

use App\Http\Middleware\isAdminMiddleware;
use App\Livewire\InformeMensual;
use App\Livewire\Inicio;
use App\Livewire\RegistroUsuarios;
use App\Livewire\ShowFichas;
use App\Livewire\ShowUsers;
use Illuminate\Support\Facades\Route;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', Inicio::class)->name('inicio');
    Route::get('/informe', InformeMensual::class)->name('informe')->middleware(isAdminMiddleware::class);
    Route::get('/show-fichas', ShowFichas::class)->name('listado')->middleware(isAdminMiddleware::class);
    Route::get("/registro-usuarios", RegistroUsuarios::class)->name('registro')->middleware(isAdminMiddleware::class);
    Route::get("/show-users", ShowUsers::class)->name('show-users')->middleware(isAdminMiddleware::class);
});

