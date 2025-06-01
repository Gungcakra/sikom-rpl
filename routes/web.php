<?php

use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\MenuManagement;
use App\Livewire\RolesPermissions;
use App\Livewire\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/login', Login::class)->name('login');
Route::get('/logout', [Login::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/user', User::class)->name('user');
    Route::get('/menu', MenuManagement::class)->name('menu');
    Route::get('/roles',RolesPermissions::class)->name('role');
    
    Route::get('/anggota', MenuManagement::class)->name('anggota');
    Route::get('/pengurus', MenuManagement::class)->name('pengurus');
    Route::get('/kegiatan', MenuManagement::class)->name('kegiatan');
    Route::get('/daftar-kegiatan-online', MenuManagement::class)->name('daftar-kegiatan-online');
    Route::get('/transaksi-keuangan', MenuManagement::class)->name('transaksi-keuangan');
    Route::get('/pengumuman', MenuManagement::class)->name('pengumuman');
    Route::get('/departement', MenuManagement::class)->name('departement');
    Route::get('/laporan-kegiatan', MenuManagement::class)->name('laporan-kegiatan');
    Route::get('/laporan-keuangan', MenuManagement::class)->name('laporan-keuangan');
    Route::get('/test', MenuManagement::class)->name('test');
});
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});