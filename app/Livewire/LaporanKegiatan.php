<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.admin')]
class LaporanKegiatan extends Component
{
    public function mount()
    {
        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });

        if (!$userPermissions->contains('masterdata-laporan-kegiatan')) {
            abort(403, 'Unauthorized action.');
        }
    }
    public function render()
    {
        return view('livewire.pages.admin.report.kegiatan');
    }
}
