<?php

use App\Livewire\Anggota;
use App\Livewire\Auth\Login;
use App\Livewire\Bank;
use App\Livewire\Dashboard;
use App\Livewire\Kegiatan;
use App\Livewire\LaporanKegiatan;
use App\Livewire\LaporanKeuangan;
use App\Livewire\MenuManagement;
use App\Livewire\Organisasi as LivewireOrganisasi;
use App\Livewire\PendaftaranKegiatan;
use App\Livewire\Pengumuman;
use App\Livewire\Pengurus;
use App\Livewire\Register;
use App\Livewire\RolesPermissions;
use App\Livewire\Transaksi;
use App\Livewire\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::get('/logout', [Login::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/user', User::class)->name('user');
    Route::get('/menu', MenuManagement::class)->name('menu');
    Route::get('/roles',RolesPermissions::class)->name('role');
    
    Route::get('/organisasi', LivewireOrganisasi::class)->name('organisasi');
    Route::get('/anggota', Anggota::class)->name('anggota');
    Route::get('/pengurus', Pengurus::class)->name('pengurus');
    Route::get('/kegiatan', Kegiatan::class)->name('kegiatan');
    Route::get('/daftar-kegiatan-online', PendaftaranKegiatan::class)->name('daftar-kegiatan-online');
    Route::get('/bank', Bank::class)->name('bank');
    Route::get('/transaksi-keuangan', Transaksi::class)->name('transaksi-keuangan');
    Route::get('/pengumuman', Pengumuman::class)->name('pengumuman');
    Route::get('/departement', MenuManagement::class)->name('departement');
    Route::get('/laporan-kegiatan', LaporanKegiatan::class)->name('laporan-kegiatan');
    Route::get('/laporan-keuangan', LaporanKeuangan::class)->name('laporan-keuangan');
    Route::get('/test', MenuManagement::class)->name('test');
});
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});