<?php

namespace App\Livewire;

use App\Models\Bank as ModelsBank;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Bank extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $bankId, $id_organisasi, $nama_bank, $nomor_rekening, $atas_nama, $nominal, $idToDelete, $userRole, $searchIdOrganisasi;
    protected $listeners = ['deleteBank'];
    public $search = '';

    public function mount()
    {
        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });

        if (!$userPermissions->contains('masterdata-bank')) {
            abort(403, 'Unauthorized action.');
        }

        $userRole = Auth::user()->roles->pluck('name')->first();
        if ($userRole === 'admin') {
            $this->userRole = 'admin';
        } else if ($userRole === 'pengurus') {
            $this->userRole = 'pengurus';
        }
    }

    public function openModal()
    {
        $this->dispatch('show-modal');
    }

    public function closeModal()
    {
        $this->bankId = null;
        $this->reset(['id_organisasi', 'nama_bank', 'nomor_rekening', 'atas_nama', 'nominal']);
        $this->dispatch('hide-modal');
    }

    public function create()
    {
        $this->openModal();
    }

    public function store()
    {
        
        $idAnggota = \App\Models\Anggota::where('id_user', Auth::id())->pluck('id_anggota');

        
        $pengurus = \App\Models\Pengurus::whereIn('id_anggota', $idAnggota)->first();

        
        if ($pengurus) {
            $anggota = \App\Models\Anggota::where('id_anggota', $pengurus->id_anggota)->first();
            if ($anggota) {
                $this->id_organisasi = $anggota->id_organisasi;
            }
        }

        try {
            $this->validate([
                'id_organisasi' => 'required|exists:organisasis,id_organisasi',
                'nama_bank' => 'required',
                'nomor_rekening' => 'required|unique:banks,nomor_rekening,' . ($this->bankId ?? 'NULL') . ',id_bank',
                'atas_nama' => 'required|string|max:255',
                'nominal' => 'required|integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
        }

        ModelsBank::updateOrCreate(
            ['id_bank' => $this->bankId],
            [
                'id_organisasi' => $this->id_organisasi,
                'nama_bank' => $this->nama_bank,
                'nomor_rekening' => $this->nomor_rekening,
                'atas_nama' => $this->atas_nama,
                'nominal' => $this->nominal,
            ]
        );

        $this->dispatch('success', 'Bank berhasil disimpan.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $this->idToDelete = $id;
        $this->dispatch('confirm-delete', 'Yakin ingin hapus bank ini?');
    }

    public function deleteBank()
    {
        ModelsBank::where('id_bank', $this->idToDelete)->delete();
        $this->dispatch('delete-success', 'Bank deleted successfully.');
    }

    public function edit($id)
    {
        $this->bankId = $id;
        $bank = ModelsBank::where('id_bank', $id)->first();
        $this->fill($bank->only(['id_organisasi', 'nama_bank', 'nomor_rekening', 'atas_nama', 'nominal']));
        $this->openModal();
    }

    public function update()
    {
        try {
            $this->validate([
            'id_organisasi' => 'required|exists:organisasis,id_organisasi',
            'nama_bank' => 'required',
            'nomor_rekening' => 'required|unique:banks,nomor_rekening,' . $this->bankId . ',id_bank',
            'atas_nama' => 'required',
            'nominal' => 'required|integer',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
        }

        ModelsBank::updateOrCreate(
            ['id_bank' => $this->bankId],
            [
            'id_organisasi' => $this->id_organisasi,
            'nama_bank' => $this->nama_bank,
            'nomor_rekening' => $this->nomor_rekening,
            'atas_nama' => $this->atas_nama,
            'nominal' => $this->nominal,
            ]
        );

        $this->dispatch('success', 'Bank Telah Diperbarui.');
        $this->closeModal();
    }

    public function render()
    {
        if ($this->userRole === 'admin') {
            return view('livewire.pages.admin.masterdata.bank.index', [
                'data' => ModelsBank::when($this->search, function ($query) {
                    $query->where('nama_bank', 'like', '%' . $this->search . '%');
                })
                ->when($this->searchIdOrganisasi, function ($query) {
                    $query->where('id_organisasi', $this->searchIdOrganisasi);
                })
                ->paginate(10),
                'organisasi' => \App\Models\Organisasi::all(),
            ]);
        } else {

            $idAnggota = \App\Models\Anggota::where('id_user', Auth::id())->pluck('id_anggota');
            $getPengurus = \App\Models\Pengurus::whereIn('id_anggota', $idAnggota)->get();
            $getIdAnggotaFromPengurus = $getPengurus->pluck('id_anggota');
            $getIdOrganisasi = \App\Models\Anggota::whereIn('id_anggota', $getIdAnggotaFromPengurus)->pluck('id_organisasi');

            return view('livewire.pages.admin.masterdata.bank.index-pengurus', [
                'data' => ModelsBank::whereIn('id_organisasi', $getIdOrganisasi)
                    ->when($this->search, function ($query) {
                        $query->where('nama_bank', 'like', '%' . $this->search . '%');
                    })
                    ->paginate(10),
            ]);
        }
    }
}
