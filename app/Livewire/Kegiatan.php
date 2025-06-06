<?php

namespace App\Livewire;

use App\Models\Kegiatan as ModelsKegiatan;
use App\Models\Organisasi;
use App\Models\PendaftaranKegiatan;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Kegiatan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $id_kegiatan, $id_organisasi, $nama_kegiatan, $deskripsi, $tanggal_pelaksanaan, $kuota_peserta, $lokasi, $status, $idToDelete, $search = '', $cek_pendaftaran = false, $userRole;
    public $listeners = ['deleteKegiatan'];

    public function mount()
    {
        $this->resetForm();

        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });

        if (!$userPermissions->contains('masterdata-kegiatan')) {
            abort(403, 'Unauthorized action.');
        }
        $userRole = Auth::user()->roles->pluck('name')->first();
        if ($userRole === 'admin') {
            $this->userRole = 'admin';
        } else if ($userRole === 'pengurus') {
            $this->userRole = 'pengurus';
        }
    }

    public function resetForm()
    {
        $this->id_kegiatan = null;
        $this->id_organisasi = '';
        $this->nama_kegiatan = '';
        $this->deskripsi = '';
        $this->tanggal_pelaksanaan = '';
        $this->kuota_peserta = '';
        $this->lokasi = '';
        $this->status = '';
        $this->search = '';
    }

    public function openModal()
    {
        $this->resetForm();
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
        if (!$this->id_organisasi) {
            $this->id_organisasi = \App\Models\Anggota::where('id_user', Auth::id())->value('id_organisasi');
        }

        $this->validate([
            'id_organisasi' => 'required|exists:organisasis,id_organisasi',
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_pelaksanaan' => 'required|date',
            'kuota_peserta' => 'required|integer|min:1',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|string|max:50',
        ]);

        ModelsKegiatan::create([
            'id_organisasi' => $this->id_organisasi,
            'nama_kegiatan' => $this->nama_kegiatan,
            'deskripsi' => $this->deskripsi,
            'tanggal_pelaksanaan' => $this->tanggal_pelaksanaan,
            'kuota_peserta' => $this->kuota_peserta,
            'lokasi' => $this->lokasi,
            'status' => $this->status,
        ]);

        $this->dispatch('success', 'Kegiatan berhasil dibuat.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $kegiatan = ModelsKegiatan::findOrFail($id);
        $this->id_kegiatan = $kegiatan->id_kegiatan;
        $this->id_organisasi = $kegiatan->id_organisasi;
        $this->nama_kegiatan = $kegiatan->nama_kegiatan;
        $this->deskripsi = $kegiatan->deskripsi;
        $this->tanggal_pelaksanaan = $kegiatan->tanggal_pelaksanaan;
        $this->kuota_peserta = $kegiatan->kuota_peserta;
        $this->lokasi = $kegiatan->lokasi;
        $this->status = $kegiatan->status;

        $this->dispatch('show-modal');
    }

    public function update()
    {
        $this->validate([
            'id_organisasi' => 'required|exists:organisasis,id_organisasi',
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_pelaksanaan' => 'required|date',
            'kuota_peserta' => 'required|integer|min:1',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|string|max:50',
        ]);


        $kegiatan = ModelsKegiatan::findOrFail($this->id_kegiatan);
        $kegiatan->update([
            'id_organisasi' => $this->id_organisasi,
            'nama_kegiatan' => $this->nama_kegiatan,
            'deskripsi' => $this->deskripsi,
            'tanggal_pelaksanaan' => $this->tanggal_pelaksanaan,
            'kuota_peserta' => $this->kuota_peserta,
            'lokasi' => $this->lokasi,
            'status' => $this->status,
        ]);

        $this->dispatch('success', 'Kegiatan berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $this->idToDelete = $id;
        $this->dispatch('confirm-delete', 'Yakin ingin menghapus?');
    }

    public function deleteKegiatan()
    {
        $kegiatan = ModelsKegiatan::find($this->idToDelete);
        if ($kegiatan) {
            $kegiatan->delete();
            $this->dispatch('delete-success', 'Kegiatan berhasil dihapus.');
        } else {
            $this->dispatch('error', 'Kegiatan tidak ditemukan.');
        }
        $this->idToDelete = null;
    }

    public function cekPendaftaran($id)
    {
        $this->cek_pendaftaran = true;
        $this->id_kegiatan = $id;
    }
    public function render()
    {
        if ($this->userRole === 'admin') {
            if (!$this->cek_pendaftaran) {
                return view('livewire.pages.admin.masterdata.kegiatan.index', [
                    'data' => ModelsKegiatan::when($this->search, function ($query) {
                        $query->where('nama_kegiatan', 'like', '%' . $this->search . '%')
                            ->orWhere('lokasi', 'like', '%' . $this->search . '%')
                            ->orWhere('status', 'like', '%' . $this->search . '%');
                    })->paginate(10),
                    'organisasis' => Organisasi::all(),
                ]);
            } else {
                return view('livewire.pages.admin.masterdata.kegiatan.pendaftaran', [
                    'dataPendaftaran' => PendaftaranKegiatan::where('id_kegiatan', $this->id_kegiatan)->when($this->search, function ($query) {
                        $query->whereHas('anggota', function ($q) {
                            $q->where('nama', 'like', '%' . $this->search . '%');
                        });
                    })->paginate(10),
                    'organisasis' => Organisasi::all(),
                ]);
            }
        } else if ($this->userRole === 'pengurus') {
            $idOrganisasi = \App\Models\Anggota::where('id_user', Auth::id())->value('id_organisasi');
            if (!$this->cek_pendaftaran) {
                return view('livewire.pages.admin.masterdata.kegiatan.index-pengurus', [
                    'data' => ModelsKegiatan::where('id_organisasi', $idOrganisasi)
                        ->when($this->search, function ($query) {
                            $query->where(function ($q) {
                                $q->where('nama_kegiatan', 'like', '%' . $this->search . '%')
                                    ->orWhere('lokasi', 'like', '%' . $this->search . '%')
                                    ->orWhere('status', 'like', '%' . $this->search . '%');
                            });
                        })->paginate(10),
                    'organisasis' => Organisasi::all(),
                ]);
            } else {
                return view('livewire.pages.admin.masterdata.kegiatan.pendaftaran', [
                    'dataPendaftaran' => PendaftaranKegiatan::where('id_kegiatan', $this->id_kegiatan)
                        ->whereHas('anggota', function ($query) use ($idOrganisasi) {
                            $query->where('id_organisasi', $idOrganisasi);
                        })
                        ->when($this->search, function ($query) {
                            $query->whereHas('anggota', function ($q) {
                                $q->where('nama', 'like', '%' . $this->search . '%');
                            });
                        })->paginate(10),
                    'organisasis' => Organisasi::all(),
                ]);
            }
        }
    }
}
