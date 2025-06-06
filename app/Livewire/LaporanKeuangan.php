<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class LaporanKeuangan extends Component
{
    public $id_transaksi, $id_bank, $nominal, $jenis_transaksi, $keterangan, $idToDelete, $search = '', $userRole, $startDate, $endDate, $searchIdOrganisasi;
    public $listeners = ['loadData'];

    public function mount()
    {

        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });

        if (!$userPermissions->contains('masterdata-laporan-keuangan')) {
            abort(403, 'Unauthorized action.');
        }

        $userRole = Auth::user()->roles->pluck('name')->first();
        $this->userRole = $userRole === 'admin' ? 'admin' : 'pengurus';
    }

    public function loadData($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function render()
    {
        if ($this->userRole === 'admin') {
            return view('livewire.pages.admin.report.keuangan.index', [
                'data' => Transaksi::when($this->search, function ($query) {
                    $query->where('keterangan', 'like', '%' . $this->search . '%')
                        ->orWhereHas('bank', function ($q2) {
                            $q2->where('nama_bank', 'like', '%' . $this->search . '%');
                        });
                })
                ->when($this->search, function ($query) {
                    $query->orWhereHas('bank', function ($q2) {
                        $q2->where('nama_bank', 'like', '%' . $this->search . '%')
                            ->orWhere('id_bank', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->searchIdOrganisasi, function ($query) {
                    $query->whereHas('bank.organisasi', function ($q3) {
                        $q3->where('id_organisasi', $this->searchIdOrganisasi);
                    });
                })
                ->when($this->startDate && $this->endDate, function ($query) {
                    $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
                })
                ->when($this->startDate && !$this->endDate, function ($query) {
                    $query->whereDate('created_at', '>=', $this->startDate);
                })
                ->when(!$this->startDate && $this->endDate, function ($query) {
                    $query->whereDate('created_at', '<=', $this->endDate);
                })
                ->get(),
                'organisasi' => \App\Models\Organisasi::all(),
            ]);
        } else {
            $idAnggota = \App\Models\Anggota::where('id_user', Auth::id())->pluck('id_anggota');

            $getPengurus = \App\Models\Pengurus::whereIn('id_anggota', $idAnggota)->get();

            $getIdAnggotaFromPengurus = $getPengurus->pluck('id_anggota');

            $anggotaPengurus = \App\Models\Anggota::whereIn('id_anggota', $getIdAnggotaFromPengurus)->get();

            $idOrganisasiPengurus = $anggotaPengurus->pluck('id_organisasi')->unique();

            $bankQuery = \App\Models\Bank::query();
            if ($this->userRole === 'pengurus' && $idOrganisasiPengurus->isNotEmpty()) {
                $bankQuery->whereIn('id_organisasi', $idOrganisasiPengurus);
            }
            $banks = $bankQuery->get();

            $idBanks = $banks->pluck('id_bank');

            $query = Transaksi::query();
            if ($idBanks->isNotEmpty()) {
                $query->whereIn('id_bank', $idBanks);
            } else {
                $query->whereRaw('0=1');
            }


            if ($this->search) {
                $query->where(function ($q) {
                    $q->where('keterangan', 'like', '%' . $this->search . '%')
                        ->orWhereHas('bank', function ($q2) {
                            $q2->where('nama_bank', 'like', '%' . $this->search . '%');
                        });
                });
            }

            if ($this->startDate && $this->endDate) {
                $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
            } elseif ($this->startDate) {
                $query->whereDate('created_at', '>=', $this->startDate);
            } elseif ($this->endDate) {
                $query->whereDate('created_at', '<=', $this->endDate);
            }

            return view('livewire.pages.admin.report.keuangan.index', [
                'data' => $query->get(),
                'banks' => $banks,
                'organisasi' => \App\Models\Organisasi::all(),
                'jenisTransaksi' => ['pemasukan' => 'Pemasukan', 'pengeluaran' => 'Pengeluaran'],
            ]);
        }
    }
}
