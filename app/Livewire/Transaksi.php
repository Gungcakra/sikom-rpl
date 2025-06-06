<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi as ModelsTransaksi;
use App\Models\Organisasi;
#[Layout('layouts.admin')]
class Transaksi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id_transaksi, $id_bank, $nominal, $jenis_transaksi, $keterangan, $idToDelete, $search = '', $userRole, $startDate, $endDate;
    public $listeners = ['deleteTransaksi','loadData'];

    public function mount()
    {
        $this->resetFields();

        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });

        if (!$userPermissions->contains('masterdata-transaksi-keuangan')) {
            abort(403, 'Unauthorized action.');
        }
        
        $userRole = Auth::user()->roles->pluck('name')->first();
        if ($userRole === 'admin') {
            $this->userRole = 'admin';
        } else if ($userRole === 'pengurus') {
            $this->userRole = 'pengurus';
        }
    }

    public function resetFields()
    {
        $this->id_transaksi = null;
        $this->id_bank = '';
        $this->nominal = '';
        $this->jenis_transaksi = '';
        $this->keterangan = '';
        $this->search = '';
    }

    public function openModal()
    {
        $this->resetFields();
        $this->dispatch('show-modal');
    }

    public function closeModal()
    {
        $this->dispatch('hide-modal');
    }

    public function create()
    {
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'id_bank' => 'required|exists:banks,id_bank',
            'nominal' => 'required|integer|min:0',
            'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
            'keterangan' => 'nullable|string',
        ]);

        try {
            $bank = \App\Models\Bank::where('id_bank', $this->id_bank)->first();

            if (!$bank) {
            $this->dispatch('error', 'Bank tidak ditemukan.');
            return;
            }

            if ($this->jenis_transaksi === 'pengeluaran' && $this->nominal > $bank->nominal) {
            $this->dispatch('error', 'Saldo bank tidak mencukupi untuk pengeluaran.');
            return;
            }

            
            $transaksi = ModelsTransaksi::create([
            'id_bank' => $this->id_bank,
            'nominal' => $this->nominal,
            'jenis_transaksi' => $this->jenis_transaksi,
            'keterangan' => $this->keterangan,
            ]);

            
            if ($this->jenis_transaksi === 'pemasukan') {
            $bank->nominal += $this->nominal;
            } elseif ($this->jenis_transaksi === 'pengeluaran') {
            $bank->nominal -= $this->nominal;
            }
            $bank->save();

            $this->dispatch('success', 'Transaksi berhasil dibuat.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('error', 'Terjadi kesalahan saat membuat transaksi.');
        }
    }
    public function delete($id)
    {
        $transaksi = ModelsTransaksi::where('id_transaksi', $id)->firstOrFail();
        $this->idToDelete = $transaksi->id_transaksi;
        $this->dispatch('confirm-delete', 'Yakin Ingin Menghapus Transaksi?');
    }
    public function deleteTransaksi()
    {
        $transaksi = ModelsTransaksi::where('id_transaksi', $this->idToDelete)->firstOrFail();
        $bank = \App\Models\Bank::where('id_bank', $transaksi->id_bank)->first();

        if ($bank) {
            if ($transaksi->jenis_transaksi === 'pengeluaran') {
                $bank->nominal += $transaksi->nominal;
            } elseif ($transaksi->jenis_transaksi === 'pemasukan') {
                $bank->nominal -= $transaksi->nominal;
            }
            $bank->save();
        }

        $transaksi->delete();
        $this->dispatch('success', 'Transaksi berhasil dihapus.');
        $this->closeModal();
    }

    public function loadData($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
 
    public function render()
    {

        
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

        $query = ModelsTransaksi::query();
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

        return view('livewire.pages.admin.masterdata.transaksi.index', [
            'data' => $query->get(),
            'banks' => $banks,
            'jenisTransaksi' => ['pemasukan' => 'Pemasukan', 'pengeluaran' => 'Pengeluaran'],
        ]);
    }
}
