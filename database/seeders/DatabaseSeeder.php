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
            'masterdata-organisasi',
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
            'masterdata-organisasi',
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
            'name' => 'Organisasi',
            'route' => 'organisasi',
            'order' => 2,
            'permission_id' => Permission::where('name', 'masterdata-organisasi')->first()->id
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

        // Seed organisasi
        \App\Models\Organisasi::insert([
            [
            'nama_organisasi' => 'Progress',
            'jenis' => 'UKM',
            'deskripsi' => 'Unit Kegiatan Mahasiswa Progress',
            'tahun_berdiri' => 2010,
            ],
            [
            'nama_organisasi' => 'Syntax',
            'jenis' => 'UKM',
            'deskripsi' => 'Unit Kegiatan Mahasiswa Syntax',
            'tahun_berdiri' => 2012,
            ],
            [
            'nama_organisasi' => 'Himatography',
            'jenis' => 'UKM',
            'deskripsi' => 'Unit Kegiatan Mahasiswa Himatography',
            'tahun_berdiri' => 2015,
            ],
        ]);
        // Create user accounts for each anggota
        $anggota1 = User::factory()->create([
            'name' => 'anggota1',
            'email' => 'anggota1@gmail.com',
            'password' => bcrypt('anggota123')
        ]);
        $anggota1->assignRole('anggota');

        $anggota2 = User::factory()->create([
            'name' => 'anggota2',
            'email' => 'anggota2@gmail.com',
            'password' => bcrypt('anggota123')
        ]);
        $anggota2->assignRole('anggota');

        $anggota3 = User::factory()->create([
            'name' => 'anggota3',
            'email' => 'anggota3@gmail.com',
            'password' => bcrypt('anggota123')
        ]);
        $anggota3->assignRole('anggota');

        // Ambil organisasi
        $organisasi1 = \App\Models\Organisasi::where('nama_organisasi', 'Progress')->first();
        $organisasi2 = \App\Models\Organisasi::where('nama_organisasi', 'Syntax')->first();
        $organisasi3 = \App\Models\Organisasi::where('nama_organisasi', 'Himatography')->first();

        // Setiap user menjadi anggota di ketiga organisasi
        foreach ([[$anggota1, 'Anggota Satu', '210001', 'Teknik Informatika'],
              [$anggota2, 'Anggota Dua', '210002', 'Sistem Informasi'],
              [$anggota3, 'Anggota Tiga', '210003', 'Teknik Komputer']] as $data) {
            [$user, $nama, $nim, $prodi] = $data;
            foreach ([$organisasi1, $organisasi2, $organisasi3] as $org) {
            \App\Models\Anggota::create([
                'id_user' => $user->id,
                'id_organisasi' => $org->id_organisasi,
                'nama' => $nama,
                'nim' => $nim,
                'no_hp' => '08' . rand(1000000000, 9999999999),
                'prodi' => $prodi,
                'tanggal_gabung' => now(),
                'status_keanggotaan' => 'aktif',
            ]);
            }
        }


        // kegiatan
        \App\Models\Kegiatan::insert([
            [
            'id_organisasi' => $organisasi1->id_organisasi,
            'nama_kegiatan' => 'Pelatihan Pemrograman',
            'deskripsi' => 'Pelatihan dasar pemrograman untuk anggota baru.',
            'tanggal_pelaksanaan' => now()->addDays(7)->toDateString(),
            'kuota_peserta' => 50,
            'lokasi' => 'Lab Komputer Progress',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'id_organisasi' => $organisasi2->id_organisasi,
            'nama_kegiatan' => 'Workshop Desain Grafis',
            'deskripsi' => 'Workshop desain grafis untuk anggota.',
            'tanggal_pelaksanaan' => now()->addDays(14)->toDateString(),
            'kuota_peserta' => 40,
            'lokasi' => 'Ruang Multimedia Syntax',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'id_organisasi' => $organisasi3->id_organisasi,
            'nama_kegiatan' => 'Seminar Teknologi Informasi',
            'deskripsi' => 'Seminar tentang perkembangan teknologi informasi terkini.',
            'tanggal_pelaksanaan' => now()->addDays(21)->toDateString(),
            'kuota_peserta' => 100,
            'lokasi' => 'Aula Himatography',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}
