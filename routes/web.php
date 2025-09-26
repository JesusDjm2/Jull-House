<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('welcome')->name('home');
});

Route::get('/Administrador', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', [RoomController::class, 'mostrar'])->name('welcome');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware(['role:admin|asistente'])->group(function () {
        Route::resource('/admins', AdminController::class)->names('admin');
        Route::resource('ambientes', RoomController::class)->names('ambientes');
    });
});

Route::get('/ambientes/{ambiente}/ver-ambiente', [RoomController::class, 'ver'])->name('ambiente.ver');

Route::get('/dashboard', function () { });


/* Route::get('/crear-roles', function () {
    $roles = ['admin', 'cliente', 'asistente'];

    foreach ($roles as $rol) {
        Role::firstOrCreate(['name' => $rol]);
    }

    return 'Roles creados correctamente ✅';
}); */

require __DIR__ . '/auth.php';