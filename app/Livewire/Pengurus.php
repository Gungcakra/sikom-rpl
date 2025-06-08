<?php

namespace App\Livewire;

use App\Models\Pengurus as ModelsPengurus;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Pengurus extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id_pengurus, $id_anggota, $jabatan, $periode_mulai, $periode_akhir, $idToDelete, $search = '', $showForm = false;
    public $listeners = ['deletePengurus'];

    public function mount()
    {
        $this->resetForm();

        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });

        if (!$userPermissions->contains('masterdata-pengurus')) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function resetForm()
    {
        $this->id_pengurus = null;
        $this->id_anggota = '';
        $this->jabatan = '';
        $this->periode_mulai = '';
        $this->periode_akhir = '';
        $this->search = '';
    }

    public function openModal()
    {
        $this->resetForm();
        $this->dispatch('show-modal');
    }

    public function closeModal()
    {
        $this->showForm = false;
        $this->resetForm();
    }

    public function create()
    {
        // $this->openModal();
        if($this->showForm) {
            $this->showForm = false;
            $this->resetForm();
        }else{
            $this->showForm = true;
        }
    }

    public function store()
    {
        try {
            $this->validate([
            'id_anggota' => 'required|exists:anggotas,id_anggota',
            'jabatan' => 'required|string|max:255',
            'periode_mulai' => 'required|date',
            'periode_akhir' => 'required|date|after_or_equal:periode_mulai',
            ]);

            $anggota = Anggota::findOrFail($this->id_anggota);
            $user = $anggota->user; 
            
            if ($user) {
            $user->syncRoles(['pengurus']);
            }

            ModelsPengurus::create([
            'id_anggota' => $this->id_anggota,
            'jabatan' => $this->jabatan,
            'periode_mulai' => $this->periode_mulai,
            'periode_akhir' => $this->periode_akhir,
            ]);

            $this->dispatch('success', 'Pengurus berhasil dibuat.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
    }

    public function edit($id)
    {
        if($this->showForm) {
            $this->showForm = false;
        }else{
            $this->showForm = true;
        }

        $pengurus = ModelsPengurus::findOrFail($id);
        $this->id_pengurus = $pengurus->id_pengurus;
        $this->id_anggota = $pengurus->id_anggota;
        $this->jabatan = $pengurus->jabatan;
        $this->periode_mulai = $pengurus->periode_mulai;
        $this->periode_akhir = $pengurus->periode_akhir;

    }

    public function update()
    {
        try {
            $this->validate([
            'id_anggota' => 'required|exists:anggotas,id_anggota',
            'jabatan' => 'required|string|max:255',
            'periode_mulai' => 'required|date',
            'periode_akhir' => 'required|date|after_or_equal:periode_mulai',
            ]);

            $pengurus = ModelsPengurus::findOrFail($this->id_pengurus);
            $pengurus->update([
            'id_anggota' => $this->id_anggota,
            'jabatan' => $this->jabatan,
            'periode_mulai' => $this->periode_mulai,
            'periode_akhir' => $this->periode_akhir,
            ]);

            $this->dispatch('success', 'Pengurus berhasil diperbarui.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $this->idToDelete = $id;
        $this->dispatch('confirm-delete', 'Yakin ingin menghapus?');
    }

    public function deletePengurus()
    {
        $pengurus = ModelsPengurus::find($this->idToDelete);
        if ($pengurus) {
            // Cari anggota terkait
            $anggota = Anggota::find($pengurus->id_anggota);
            if ($anggota && $anggota->user) {
            // Ubah role user menjadi 'anggota'
            $anggota->user->syncRoles(['anggota']);
            }
            $pengurus->delete();
            $this->dispatch('delete-success', 'Pengurus berhasil dihapus.');
        } else {
            $this->dispatch('error', 'Pengurus tidak ditemukan.');
        }
        $this->idToDelete = null;
    }

    public function render()
    {
        // Ambil semua id_anggota yang sudah menjadi pengurus
        $pengurusAnggotaIds = ModelsPengurus::pluck('id_anggota')->toArray();

        // Ambil semua nim dari anggota yang sudah menjadi pengurus
        $nimsSudahPengurus = Anggota::whereIn('id_anggota', $pengurusAnggotaIds)->pluck('nim')->toArray();
        
        return view('livewire.pages.admin.masterdata.pengurus.index', [
            'data' => ModelsPengurus::with('anggota')
            ->when($this->search, function ($query) {
                $query->whereHas('anggota', function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%');
                })->orWhere('jabatan', 'like', '%' . $this->search . '%');
            })
            ->paginate(10),
            // Hanya tampilkan anggota yang nim-nya belum pernah jadi pengurus di organisasi manapun
            'anggotas' => Anggota::whereNotIn('nim', $nimsSudahPengurus)->get(),
        ]);
        
    }
}
