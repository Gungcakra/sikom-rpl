<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Customer;
use App\Models\Departement;
use App\Models\Employee;
use App\Models\Menu;
use App\Models\Service;
use App\Models\SparePart;
use App\Models\SubMenu;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {




        // Create roles
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $pengurus = Role::firstOrCreate(['name' => 'pengurus', 'guard_name' => 'web']);
        $anggota = Role::firstOrCreate(['name' => 'anggota', 'guard_name' => 'web']);

        // Define permissions
        $permissions = [
            'dashboard',
            'masterdata-anggota',
            'masterdata-pengurus',
            'masterdata-kegiatan',
            'masterdata-daftar-kegiatan-online',
            'masterdata-transaksi-keuangan',
            'masterdata-pengumuman',
            'masterdata-laporan-kegiatan',
            'masterdata-laporan-keuangan',
            'masterdata-user',
            'masterdata-role',
            'masterdata-menu',
            'masterdata-departement',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $admin->syncPermissions($permissions);

        $pengurus->syncPermissions([
            'dashboard',
            'masterdata-anggota',
            'masterdata-pengurus',
            'masterdata-kegiatan',
            'masterdata-daftar-kegiatan-online',
            'masterdata-transaksi-keuangan',
            'masterdata-pengumuman',
            'masterdata-laporan-kegiatan',
            'masterdata-laporan-keuangan',
            'masterdata-menu',
            'masterdata-departement',
        ]);

        $anggota->syncPermissions([
            'dashboard',
            'masterdata-kegiatan',
            'masterdata-daftar-kegiatan-online',
        ]);

        // Create users for each role
        $adminUser = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('adminsikom')
        ]);
        $adminUser->assignRole('admin');

        $pengurusUser = User::factory()->create([
            'name' => 'pengurus',
            'email' => 'pengurus@gmail.com',
            'password' => bcrypt('pengurus123')
        ]);
        $pengurusUser->assignRole('pengurus');

        $anggotaUser = User::factory()->create([
            'name' => 'anggota',
            'email' => 'anggota@gmail.com',
            'password' => bcrypt('anggota123')
        ]);
        $anggotaUser->assignRole('anggota');

        // Menu Dashboard
        $dashboard = Menu::create([
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-house',
            'route' => 'dashboard',
            'order' => 1,
        ]);

        SubMenu::create([
            'menu_id' => $dashboard->id,
            'name' => 'Monitoring',
            'route' => 'dashboard',
            'order' => 1,
            'permission_id' => Permission::where('name', 'dashboard')->first()->id
        ]);

        // Menu Master Data
        $masterData = Menu::create([
            'name' => 'Master Data',
            'icon' => 'fa-solid fa-database',
            'route' => null,
            'order' => 2
        ]);
        // Only for admin
        SubMenu::create([
            'menu_id' => $masterData->id,
            'name' => 'User',
            'route' => 'user',
            'order' => 7,
            'permission_id' => Permission::where('name', 'masterdata-user')->first()->id
        ]);
        SubMenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Role',
            'route' => 'role',
            'order' => 8,
            'permission_id' => Permission::where('name', 'masterdata-role')->first()->id
        ]);
        SubMenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Menu',
            'route' => 'menu',
            'order' => 9,
            'permission_id' => Permission::where('name', 'masterdata-menu')->first()->id
        ]);

        SubMenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Anggota',
            'route' => 'anggota',
            'order' => 1,
            'permission_id' => Permission::where('name', 'masterdata-anggota')->first()->id
        ]);
        SubMenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Pengurus',
            'route' => 'pengurus',
            'order' => 2,
            'permission_id' => Permission::where('name', 'masterdata-pengurus')->first()->id
        ]);
        SubMenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Kegiatan',
            'route' => 'kegiatan',
            'order' => 3,
            'permission_id' => Permission::where('name', 'masterdata-kegiatan')->first()->id
        ]);
        SubMenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Daftar Kegiatan Online',
            'route' => 'daftar-kegiatan-online',
            'order' => 4,
            'permission_id' => Permission::where('name', 'masterdata-daftar-kegiatan-online')->first()->id
        ]);
        SubMenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Transaksi Keuangan',
            'route' => 'transaksi-keuangan',
            'order' => 5,
            'permission_id' => Permission::where('name', 'masterdata-transaksi-keuangan')->first()->id
        ]);
        SubMenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Pengumuman',
            'route' => 'pengumuman',
            'order' => 6,
            'permission_id' => Permission::where('name', 'masterdata-pengumuman')->first()->id
        ]);

        // Menu Laporan
        $laporanMenu = Menu::create([
            'name' => 'Laporan',
            'icon' => 'fa-solid fa-file-lines',
            'route' => null,
            'order' => 3
        ]);
        SubMenu::create([
            'menu_id' => $laporanMenu->id,
            'name' => 'Laporan Kegiatan',
            'route' => 'laporan-kegiatan',
            'order' => 1,
            'permission_id' => Permission::where('name', 'masterdata-laporan-kegiatan')->first()->id
        ]);
        SubMenu::create([
            'menu_id' => $laporanMenu->id,
            'name' => 'Laporan Keuangan',
            'route' => 'laporan-keuangan',
            'order' => 2,
            'permission_id' => Permission::where('name', 'masterdata-laporan-keuangan')->first()->id
        ]);
    }
}
