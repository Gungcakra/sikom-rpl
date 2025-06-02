<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Pengumuman extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['deletePengumuman'];
    public $idPengumuman, $idToDelete, $search = '', $id_organisasi, $judul, $isi;

    public function mount()
    {
        $this->idPengumuman = null;
        $this->search = '';
        $this->id_organisasi = null;
        $this->judul = '';
        $this->isi = '';
        

        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });

        if (!$userPermissions->contains('masterdata-pengumuman')) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function openModal()
    {
        $this->reset(['idPengumuman', 'search', 'id_organisasi', 'judul', 'isi']);
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
        try {
            // Set id_organisasi if not set
            if (!$this->id_organisasi) {
                $this->id_organisasi = \App\Models\Anggota::where('id_user', Auth::id())->value('id_organisasi');
            }

            $this->validate([
                'id_organisasi' => 'required|exists:organisasis,id_organisasi',
                'judul' => 'required|string|max:255',
                'isi' => 'required|string',
            ]);

            \App\Models\Pengumuman::create([
                'id_organisasi' => $this->id_organisasi,
                'judul' => $this->judul,
                'isi' => $this->isi,
                'tanggal_post' => now(),
            ]);

            $this->dispatch('success', 'Pengumuman berhasil dibuat.');
            $this->closeModal();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', 'Gagal membuat pengumuman: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $pengumuman = \App\Models\Pengumuman::findOrFail($id);
        $this->idPengumuman = $pengumuman->id_pengumuman;
        $this->id_organisasi = $pengumuman->id_organisasi;
        $this->judul = $pengumuman->judul;
        $this->isi = $pengumuman->isi;

        $this->dispatch('show-modal');
    }
    public function update()
    {
        $this->validate([
            'id_organisasi' => 'required|exists:organisasis,id_organisasi',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $pengumuman = \App\Models\Pengumuman::findOrFail($this->idPengumuman);
        $pengumuman->update([
            'id_organisasi' => $this->id_organisasi,
            'judul' => $this->judul,
            'isi' => $this->isi,
            'tanggal_post' => now(),
        ]);
        $this->dispatch('success', 'Pengumuman berhasil diperbarui.');
        $this->closeModal();
    }
    public function delete($id)
    {
        $pengumuman = \App\Models\Pengumuman::findOrFail($id);
        $this->idToDelete = $pengumuman->id_pengumuman;
        $this->dispatch('confirm-delete', 'Yakin Ingin Menhapus?.');
    }
    public function deletePengumuman()
    {
        $pengumuman = \App\Models\Pengumuman::findOrFail($this->idToDelete);
        $pengumuman->delete();
        $this->dispatch('delete-success', 'Pengumuman berhasil dihapus.');
        $this->idToDelete = null;
    }
    public function render()
    {
        return view('livewire.pages.admin.masterdata.pengumuman.index', [
            'data' => \App\Models\Pengumuman::when($this->search, function ($query) {
                $query->where('judul', 'like', '%' . $this->search . '%')
                      ->orWhere('isi', 'like', '%' . $this->search . '%');
            })->paginate(10),
            'organisasi' => \App\Models\Organisasi::all(),
        ]);
    }
}
