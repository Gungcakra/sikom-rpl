<?php

namespace App\Livewire;

use App\Models\Anggota as ModelsAnggota;
use App\Models\Organisasi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Anggota extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $idAnggota, $id_user, $id_organisasi, $nama, $nim, $no_hp, $prodi, $tanggal_gabung, $status_keanggotaan, $idToDelete, $search = '';
    public $listeners = ['deleteAnggota'];

    public function mount()
    {
        $this->resetFields();

        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });

        if (!$userPermissions->contains('masterdata-anggota')) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function resetFields()
    {
        $this->idAnggota = null;
        $this->id_user = '';
        $this->id_organisasi = '';
        $this->nama = '';
        $this->nim = '';
        $this->no_hp = '';
        $this->prodi = '';
        $this->tanggal_gabung = '';
        $this->status_keanggotaan = '';
    }

    public function edit($id)
    {
        $anggota = ModelsAnggota::findOrFail($id);
        $this->idAnggota = $anggota->id_anggota;
        $this->id_user = $anggota->id_user;
        $this->id_organisasi = $anggota->id_organisasi;
        $this->nama = $anggota->nama;
        $this->nim = $anggota->nim;
        $this->no_hp = $anggota->no_hp;
        $this->prodi = $anggota->prodi;
        $this->tanggal_gabung = $anggota->tanggal_gabung;
        $this->status_keanggotaan = $anggota->status_keanggotaan;

        $this->dispatch('show-modal');
    }

    public function update()
    {
        $this->validate([
            'id_user' => 'required|exists:users,id',
            'id_organisasi' => 'required|exists:organisasis,id_organisasi',
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'no_hp' => 'required|string|max:20',
            'prodi' => 'required|string|max:100',
            'tanggal_gabung' => 'required|date',
            'status_keanggotaan' => 'required|string|max:50',
        ]);

        $anggota = ModelsAnggota::findOrFail($this->idAnggota);
        $anggota->update([
            'id_user' => $this->id_user,
            'id_organisasi' => $this->id_organisasi,
            'nama' => $this->nama,
            'nim' => $this->nim,
            'no_hp' => $this->no_hp,
            'prodi' => $this->prodi,
            'tanggal_gabung' => $this->tanggal_gabung,
            'status_keanggotaan' => $this->status_keanggotaan,
        ]);

        $this->dispatch('success', 'Data anggota berhasil diperbarui.');
        $this->dispatch('hide-modal');
        $this->resetFields();
    }

    public function delete($id)
    {
        $this->idToDelete = $id;
        $this->dispatch('confirm-delete', 'Yakin ingin menghapus anggota?');
    }

    public function deleteAnggota()
    {
        $anggota = ModelsAnggota::find($this->idToDelete);
        if ($anggota) {
            $anggota->delete();
            $this->dispatch('delete-success', 'Data anggota berhasil dihapus.');
        } else {
            $this->dispatch('error', 'Data anggota tidak ditemukan.');
        }
        $this->idToDelete = null;
    }

    public function render()
    {
        return view('livewire.pages.admin.masterdata.anggota.index', [
            'data' => ModelsAnggota::when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('nim', 'like', '%' . $this->search . '%');
            })->paginate(10),
            'organisasi' => Organisasi::all(),
            'users' => User::all(),
        ]);
    }
}
