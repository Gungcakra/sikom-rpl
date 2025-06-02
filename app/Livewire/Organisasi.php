<?php

namespace App\Livewire;

use App\Models\Organisasi as ModelsOrganisasi;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout('layouts.admin')]
class Organisasi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id_organisasi, $nama_organisasi, $jenis, $deskripsi, $tahun_berdiri, $idToDelete, $search = '';
    public $listeners = ['deleteOrganisasi'];
    public function mount()
    {
        $this->id_organisasi = null;
        $this->nama_organisasi = '';
        $this->jenis = '';
        $this->deskripsi = '';
        $this->tahun_berdiri = '';
        $this->search = '';

        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });

        if (!$userPermissions->contains('masterdata-organisasi')) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function openModal()
    {
        $this->reset(['id_organisasi', 'nama_organisasi', 'jenis', 'deskripsi', 'tahun_berdiri']);
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
            'nama_organisasi' => 'required|string|max:255',
            'jenis' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        \App\Models\Organisasi::create([
            'nama_organisasi' => $this->nama_organisasi,
            'jenis' => $this->jenis,
            'deskripsi' => $this->deskripsi,
            'tahun_berdiri' => $this->tahun_berdiri,
        ]);

        $this->dispatch('success', 'Organisasi berhasil dibuat.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $organisasi = \App\Models\Organisasi::findOrFail($id);
        $this->id_organisasi = $organisasi->id_organisasi;
        $this->nama_organisasi = $organisasi->nama_organisasi;
        $this->jenis = $organisasi->jenis;
        $this->deskripsi = $organisasi->deskripsi;
        $this->tahun_berdiri = $organisasi->tahun_berdiri;

        $this->dispatch('show-modal');
    }

    public function update()
    {
        $this->validate([
            'nama_organisasi' => 'required|string|max:255',
            'jenis' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        $organisasi = \App\Models\Organisasi::findOrFail($this->id_organisasi);
        $organisasi->update([
            'nama_organisasi' => $this->nama_organisasi,
            'jenis' => $this->jenis,
            'deskripsi' => $this->deskripsi,
            'tahun_berdiri' => $this->tahun_berdiri,
        ]);

        $this->dispatch('success', 'Organisasi berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $this->idToDelete = $id;
        $this->dispatch('confirm-delete', 'Yakin ingin menghapus?');
    }

    public function deleteOrganisasi()
    {
        $organisasi = \App\Models\Organisasi::find($this->idToDelete);
        if ($organisasi) {
            $organisasi->delete();
            $this->dispatch('delete-success', 'Organisasi berhasil dihapus.');
        } else {
            $this->dispatch('error', 'Organisasi tidak ditemukan.');
        }
        $this->idToDelete = null;
    }
    public function render()
    {
        return view('livewire.pages.admin.masterdata.organisasi.index',[
            'data' => ModelsOrganisasi::when($this->search, function ($query) {
                $query->where('nama_organisasi', 'like', '%' . $this->search . '%')
                      ->orWhere('jenis', 'like', '%' . $this->search . '%');
            })->paginate(10)
        ]);
    }
}
