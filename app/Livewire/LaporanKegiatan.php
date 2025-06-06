<?php

namespace App\Livewire;

use App\Models\Kegiatan;
use App\Models\Organisasi;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class LaporanKegiatan extends Component
{
    public $searchIdOrganisasi, $userRoles, $search = '', $startDate, $endDate;
    public $listeners = ['loadData'];

    public function loadData($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function mount()
    {
        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });

        if (!$userPermissions->contains('masterdata-laporan-kegiatan')) {
            abort(403, 'Unauthorized action.');
        }

        $userRoles = Auth::user()->roles->pluck('name')->first();
        if ($userRoles === 'admin') {
            $this->userRoles = 'admin';
        } elseif ($userRoles === 'pengurus') {
            $this->userRoles = 'pengurus';
        }
    }
    public function render()
    {
        if ($this->userRoles === 'admin') {
            return view('livewire.pages.admin.report.kegiatan.index', [
                'organisasi' => Organisasi::all(),
                'data' => \App\Models\Kegiatan::when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('nama_kegiatan', 'like', '%' . $this->search . '%')
                            ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->startDate && $this->endDate, function ($query) {
                    $query->whereBetween('tanggal_pelaksanaan', [$this->startDate, $this->endDate]);
                })
                ->when($this->searchIdOrganisasi, function ($query) {
                    $query->whereHas('organisasi', function ($orgQuery) {
                        $orgQuery->where('id_organisasi', $this->searchIdOrganisasi);
                    });
                })
                ->get()
            ]);
        } else {
            $idAnggota = \App\Models\Anggota::where('id_user', Auth::id())->pluck('id_anggota');
            $getPengurus = \App\Models\Pengurus::whereIn('id_anggota', $idAnggota)->get();
            $getIdAnggotaFromPengurus = $getPengurus->pluck('id_anggota');
            $anggotaPengurus = \App\Models\Anggota::whereIn('id_anggota', $getIdAnggotaFromPengurus)->get();
            $idOrganisasiPengurus = $anggotaPengurus->pluck('id_organisasi')->unique();

            return view('livewire.pages.admin.report.kegiatan.index', [
                'organisasi' => Organisasi::all(),
                'data' => \App\Models\Kegiatan::whereIn('id_organisasi', $idOrganisasiPengurus)
                    ->when($this->search, function ($query) {
                        $query->where(function ($q) {
                            $q->where('nama_kegiatan', 'like', '%' . $this->search . '%')
                              ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
                        });
                    })
                    ->when($this->startDate && $this->endDate, function ($query) {
                        $query->whereBetween('tanggal_pelaksanaan', [$this->startDate, $this->endDate]);
                    })
                    ->when($this->searchIdOrganisasi, function ($query) {
                        $query->whereHas('organisasi', function ($q) {
                            $q->where('id_organisasi', $this->searchIdOrganisasi);
                        });
                    })
                    ->get()
            ]);
        }
    }
}
