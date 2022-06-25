<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes([
    'register' => false,
    'verify' => false
]);

Route::middleware('auth')->group(function(){
    Route::get('/', App\Http\Livewire\Home::class)->name('index');
    Route::get('/home', App\Http\Livewire\Home::class)->name('home');
    Route::get('/papeis', App\Http\Livewire\Papeis::class)->name('papeis');
    Route::get('/permissoes', App\Http\Livewire\Permissoes::class)->name('permissoes');
    Route::get('/papeis-permissoes/{idPapel}', App\Http\Livewire\PapeisPermissoes::class)->name('papeis-permissoes');
    Route::get('/usuarios', App\Http\Livewire\Usuarios::class)->name('usuarios');
    Route::get('/paginas', App\Http\Livewire\Paginas::class)->name('paginas');
    Route::get('/perfil', App\Http\Livewire\Perfil::class)->name('perfil');
});