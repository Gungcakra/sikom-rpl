<?php

namespace App\Livewire;

use App\Models\Organisasi;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class Register extends Component
{
    public $nama = '', $nim = '', $no_hp = '', $prodi = '', $id_organisasi = [], $name = '', $email = '', $password = '';


    public function register()
    {

        try {
            // Validasi input, urut sesuai tampilan form
            $this->validate([
                'nama' => 'required|string|max:255',
                'nim' => 'required|string|max:50|unique:anggotas,nim',
                'no_hp' => 'required|string|max:20',
                'prodi' => 'required|string|max:100',
                'id_organisasi' => 'required|exists:organisasis,id_organisasi',
                'name' => 'required|string|max:255|unique:users,name',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
            ]);

            // Buat user baru
            $user = \App\Models\User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);

            // Beri role anggota
            $user->assignRole('anggota');
            $getIdUser = \App\Models\User::where('email', $this->email)->first();
            if ($getIdUser) {
                foreach ($this->id_organisasi as $orgId) {
                    \App\Models\Anggota::create([
                        'id_user' => $getIdUser->id,
                        'id_organisasi' => $orgId,
                        'nama' => $this->nama,
                        'nim' => $this->nim,
                        'no_hp' => $this->no_hp,
                        'prodi' => $this->prodi,
                        'tanggal_gabung' => now(),
                        'status_keanggotaan' => 'aktif',
                    ]);
                }
            }

            // Autologin jika berhasil
            if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
                $loginLog = \App\Models\LoginLog::create([
                    'id_user' => Auth::id(),
                    'waktu_login' => now(),
                ]);

                if (!$loginLog) {
                    $this->dispatch('error', 'Gagal mencatat waktu login.');
                    return;
                }

                session()->regenerate();
                session(['user_id' => Auth::id()]);
                return $this->dispatch('success-login', 'Login berhasil.');
            } else {
                $this->dispatch('error', 'Login gagal. Silakan coba lagi.');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            foreach ($e->validator->errors()->all() as $error) {
                $this->dispatch('error', $error);
            }
        } catch (\Exception $e) {
            $this->dispatch('error', 'Terjadi kesalahan saat registrasi: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.auth.register', [
            'organisasi' => Organisasi::all(),
        ]);
    }
}
