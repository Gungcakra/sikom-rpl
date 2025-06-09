<?php

namespace App\Livewire;

use App\Models\Anggota;
use App\Models\Menu;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public $totalKegiatanAnggota = 0, $organisasiDiikuti = 0, $pengumumanSaya = [], $totalAnggotaOrganisasi = 0, $totalKegiatanOrganisasi = 0, $totalSaldoOrganisasi;
    public function mount()
    {
        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });

        if (!$userPermissions->contains('dashboard')) {
            abort(403, 'Unauthorized action.');
        }
        $checkRoleUser = Auth::user()->roles->pluck('name');

        // Jika user adalah anggota, ambil id anggotanya dari tabel anggota
        if ($checkRoleUser->contains('anggota')) {
            $anggotaList = \App\Models\Anggota::where('id_user', Auth::id())->get();
            if ($anggotaList->isNotEmpty()) {
            $anggotaIds = $anggotaList->pluck('id_anggota');
            $organisasiIds = $anggotaList->pluck('id_organisasi');
            $pendaftaranKegiatan = \App\Models\PendaftaranKegiatan::whereIn('id_anggota', $anggotaIds)->get();
            $this->totalKegiatanAnggota = $pendaftaranKegiatan;
            $this->organisasiDiikuti = $anggotaList;
            $this->pengumumanSaya = \App\Models\Pengumuman::whereIn('id_organisasi', $organisasiIds)->orderBy('created_at', 'desc')->get();
            }
        
        } else if ($checkRoleUser->contains('pengurus')) {
            $this->getDataKepengurusan();
        }
    }
    public function getDataKepengurusan()
    {
        $idAnggota = \App\Models\Anggota::where('id_user', Auth::id())
            ->pluck('id_anggota');
        $getPengurus = \App\Models\Pengurus::whereIn('id_anggota', $idAnggota)->get();
        $getIdAnggotaFromPengurus = $getPengurus->pluck('id_anggota');
        $getIdOrganisasi = \App\Models\Anggota::whereIn('id_anggota', $getIdAnggotaFromPengurus)->pluck('id_organisasi')->first();
        $this->totalAnggotaOrganisasi =  \App\Models\Anggota::where('id_organisasi', $getIdOrganisasi)->get();
        $this->totalKegiatanOrganisasi = \App\Models\Kegiatan::where('id_organisasi', $getIdOrganisasi)->count();

        $this->totalSaldoOrganisasi = \App\Models\Bank::where('id_organisasi', $getIdOrganisasi)->sum('nominal');
    }
    public function render()
    {
        // Hitung user yang login hari ini (unik per user, hanya yang waktu_logout kosong, gunakan yang terbaru)
        $today = now()->toDateString();

        $userActiveTodayCount = \App\Models\LoginLog::whereDate('waktu_login', $today)
            ->whereNull('waktu_logout')
            ->distinct('id_user')
            ->count('user_id');

        $user = Auth::user();
        $roles = $user->roles->pluck('name')->toArray();

        if (in_array('admin', $roles)) {
            // Dashboard untuk admin
            return view('livewire.pages.admin.dashboard', [
                'organisasiCount' => \App\Models\Organisasi::count(),
                'userCount' => \App\Models\User::count(),
                'kegiatanCount' => \App\Models\Kegiatan::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count(),
                'userActiveTodayCount' => $userActiveTodayCount,
            ]);
        } elseif (in_array('pengurus', $roles)) {
            return view('livewire.pages.admin.dashboardpengurus', [

                'totalAnggota' => $this->totalAnggotaOrganisasi,
                'totalKegiatan' => $this->totalKegiatanOrganisasi,
                'totalSaldo' => $this->totalSaldoOrganisasi,
            ]);
        } elseif (in_array('anggota', $roles)) {

            return view('livewire.pages.admin.dashboardanggota', [

                'kegiatanSaya' => $this->totalKegiatanAnggota,
                'organisasiDiikuti' => $this->organisasiDiikuti,
                'pengumumanSaya' => $this->pengumumanSaya,
            ]);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
