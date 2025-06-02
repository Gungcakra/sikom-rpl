<?php

namespace App\Livewire\Auth;

use App\Models\LoginLog;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Login extends Component
{
    public $email, $password, $remember;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (!\App\Models\User::where('email', $this->email)->exists()) {
            $this->dispatch('error', 'Email is not registered.');
            return;
        }

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
           $loginLog = LoginLog::create([
                'id_user' => Auth::id(),
                'waktu_login' => now(),
            ]);
            if (!$loginLog) {
                $this->dispatch('error', 'Failed to log login time.');
                return;
            }else {
                session()->regenerate();
    
                session(['user_id' => Auth::id()]);
    
                return $this->dispatch('success-login', 'Login successful.');
            }
        } else {
            $this->dispatch('error', 'Invalid email or password.');
        }
    }

    public function logout()
    {
        Auth::logout();
        LoginLog::where('id_user', Auth::id())
            ->whereNull('waktu_logout')
            ->update(['waktu_logout' => now()]);
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
