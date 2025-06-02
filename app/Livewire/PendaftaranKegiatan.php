<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class PendaftaranKegiatan extends Component
{
    public $id_kegiatan, $search = '', $idOrganisasiAnggotaUser;

    public function mount()
    {
        $this->idOrganisasiAnggotaUser = Auth::user()->anggota;
    }
    public function daftar($id)
    {
        try {

            // Ambil id anggota dari user yang organisasi-nya sama dengan organisasi kegiatan ini
            $kegiatan = Kegiatan::findOrFail($id);
            $idOrganisasiKegiatan = $kegiatan->id_organisasi;
            $getIdAnggotaOrganisasi = collect(Auth::user()->anggota)
                ->where('id_organisasi', $idOrganisasiKegiatan)
                ->pluck('id_anggota')
                ->first();
                
            // Cek apakah user sudah mendaftar pada kegiatan ini
            $sudahDaftar = \App\Models\PendaftaranKegiatan::where('id_kegiatan', $id)
                ->where('id_anggota', $getIdAnggotaOrganisasi ?? null)
                ->exists();

            if ($sudahDaftar) {
                $this->dispatch('error', 'Anda sudah terdaftar pada kegiatan ini.');
                return;
            }

            // Cek apakah kuota peserta masih tersedia
            $kegiatan = Kegiatan::findOrFail($id);
            if ($kegiatan->kuota_peserta <= 0) {
                $this->dispatch('error', 'Kuota peserta untuk kegiatan ini sudah penuh.');
                return;
            }
            // Buat pendaftaran baru
            \App\Models\PendaftaranKegiatan::create([
                'id_kegiatan' => $id,
                'id_anggota' => $getIdAnggotaOrganisasi,
                'status' => 'ikut',
                'tanggal_daftar' => now(),
            ]);
            // Kurangi kuota peserta
            $kegiatan->kuota_peserta -= 1;
            $kegiatan->save();
            $this->dispatch('success', 'Anda berhasil mendaftar pada kegiatan ini.');
        } catch (\Exception $e) {
            $this->dispatch('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {

        return view('livewire.pages.admin.masterdata.daftarkegiatan.index', [
            'data' => Kegiatan::when($this->search, function ($query) {
                $query->where('nama_kegiatan', 'like', '%' . $this->search . '%');
            })
                ->when($this->idOrganisasiAnggotaUser, function ($query) {
                    // Ambil semua id organisasi dari anggota user
                    $organisasiIds = collect($this->idOrganisasiAnggotaUser)->pluck('id_organisasi')->toArray();
                    $query->whereIn('id_organisasi', $organisasiIds);
                })
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }
}
