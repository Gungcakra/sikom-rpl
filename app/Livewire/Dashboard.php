<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public $totalKegiatanAnggota = 0, $organisasiDiikuti = 0, $pengumumanSaya = [];
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
            $anggota = \App\Models\Anggota::where('id_user', Auth::id())->first();
            if ($anggota) {
                $pendaftaranKegiatan = \App\Models\PendaftaranKegiatan::where('id_anggota', $anggota->id_anggota)->get();
                $this->totalKegiatanAnggota = $pendaftaranKegiatan;
            }
            $this->organisasiDiikuti = \App\Models\Anggota::where('id_user', Auth::id())->get();
            $this->pengumumanSaya = \App\Models\Pengumuman::whereHas('organisasi', function ($query) use ($anggota) {
                $query->where('id_organisasi', $anggota->id_organisasi);
            })->get();
            
            // $this->id_anggota = $anggota->id_anggota; // Misalnya, jika ingin menyimpan id anggota
        }
        
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
            // Dashboard untuk pengurus
            return view('livewire.pages.pengurus.dashboard', [
            // Tambahkan data khusus pengurus di sini
           
            'userActiveTodayCount' => $userActiveTodayCount,
            ]);
        } elseif (in_array('anggota', $roles)) {
           
            return view('livewire.pages.admin.dashboardanggota', [
            
            // 'kegiatanSayaCount' => \App\Models\Kegiatan::whereHas('anggota', function ($q) use ($user) {
            //     $q->where('user_id', $user->id);
            // })->count(),
            // 'kegiatanSayaCount' => \App\Models\Kegiatan::whereHas('anggota', function ($q) use ($user) {
            //     $q->where('id_user', $user->id);
            // })->count(),
            'kegiatanSaya' => $this->totalKegiatanAnggota,
            'organisasiDiikuti' => $this->organisasiDiikuti,
            'pengumumanSaya' => $this->pengumumanSaya,
            ]);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
