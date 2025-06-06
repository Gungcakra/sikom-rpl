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
            'masterdata-bank',
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
        $admin->syncPermissions([
            'dashboard',
            'masterdata-organisasi',
            'masterdata-anggota',
            'masterdata-pengurus',
            'masterdata-kegiatan',
            'masterdata-pengumuman',
            'masterdata-laporan-kegiatan',
            'masterdata-laporan-keuangan',
            'masterdata-user',
            // 'masterdata-role',
            // 'masterdata-menu',
            // 'masterdata-bank',
            'masterdata-departement',
        ]);

        $pengurus->syncPermissions([
            'dashboard',
            // 'masterdata-organisasi',
            'masterdata-anggota',
            'masterdata-pengurus',
            'masterdata-kegiatan',
            'masterdata-transaksi-keuangan',
            'masterdata-pengumuman',
            'masterdata-laporan-kegiatan',
            'masterdata-laporan-keuangan',
            'masterdata-bank',
            // 'masterdata-menu',
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
            'name' => 'Bank',
            'route' => 'bank',
            'order' => 5,
            'permission_id' => Permission::where('name', 'masterdata-bank')->first()->id
        ]);
        SubMenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Transaksi Keuangan',
            'route' => 'transaksi-keuangan',
            'order' => 6,
            'permission_id' => Permission::where('name', 'masterdata-transaksi-keuangan')->first()->id
        ]);
        SubMenu::create([
            'menu_id' => $masterData->id,
            'name' => 'Pengumuman',
            'route' => 'pengumuman',
            'order' => 7,
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
            'nama_organisasi' => 'Senat Mahasiswa STIKOM Bali',
            'jenis' => 'Organisasi',
            'deskripsi' => 'Senat Mahasiswa STIKOM Bali',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Badan Legislatif Mahasiswa STIKOM Bali',
            'jenis' => 'Organisasi',
            'deskripsi' => 'Badan Legislatif Mahasiswa STIKOM Bali',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Kesatuan Mahasiswa Hindu Dharma STIKOM Bali',
            'jenis' => 'Organisasi',
            'deskripsi' => 'Kesatuan Mahasiswa Hindu Dharma STIKOM Bali',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Moslem Community of STIKOM Bali (MCOS)',
            'jenis' => 'Organisasi',
            'deskripsi' => 'Moslem Community of STIKOM Bali (MCOS)',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Persaudaraan Mahasiswa Kristiani (PMK)',
            'jenis' => 'Organisasi',
            'deskripsi' => 'Persaudaraan Mahasiswa Kristiani (PMK)',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'UKM Multimedia',
            'jenis' => 'UKM',
            'deskripsi' => 'UKM Multimedia',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'UKM Robotic',
            'jenis' => 'UKM',
            'deskripsi' => 'UKM Robotic',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'UKM Programmer (Progress)',
            'jenis' => 'UKM',
            'deskripsi' => 'UKM Programmer (Progress)',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Komunitas Linux STIKOM Bali',
            'jenis' => 'Komunitas',
            'deskripsi' => 'Komunitas Linux STIKOM Bali',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Computer Club Technopreneurship',
            'jenis' => 'Komunitas',
            'deskripsi' => 'Computer Club Technopreneurship',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Himpunan Mahasiswa Jurnalistik (HIMAJESTIK)',
            'jenis' => 'Himpunan',
            'deskripsi' => 'Himpunan Mahasiswa Jurnalistik (HIMAJESTIK)',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Himaprodi SI (Himpunan Mahasiswa Program Studi Sistem Informasi)',
            'jenis' => 'Himpunan',
            'deskripsi' => 'Himaprodi SI (Himpunan Mahasiswa Program Studi Sistem Informasi)',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Himatography (Himpunan Mahasiswa Photography STIKOM Bali)',
            'jenis' => 'Himpunan',
            'deskripsi' => 'Himatography (Himpunan Mahasiswa Photography STIKOM Bali)',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Korps Suka Rela PMI (KSR PMI) Widya Bhakti',
            'jenis' => 'Organisasi',
            'deskripsi' => 'Korps Suka Rela PMI (KSR PMI) Widya Bhakti',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Voice of STIKOM Bali (VOS)',
            'jenis' => 'Komunitas',
            'deskripsi' => 'Voice of STIKOM Bali (VOS)',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Komunitas Mahasiswa Pecinta Alam STIKOM Bali (KOMPAST)',
            'jenis' => 'Komunitas',
            'deskripsi' => 'Komunitas Mahasiswa Pecinta Alam STIKOM Bali (KOMPAST)',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Stikom Bali Music Community (SBMC)',
            'jenis' => 'Komunitas',
            'deskripsi' => 'Stikom Bali Music Community (SBMC)',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'UKM Modern Dance',
            'jenis' => 'UKM',
            'deskripsi' => 'UKM Modern Dance',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'Tabuh “Bramara Gita”',
            'jenis' => 'UKM',
            'deskripsi' => 'Tabuh “Bramara Gita”',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'UKM Pragina STIKOM Bali',
            'jenis' => 'UKM',
            'deskripsi' => 'UKM Pragina STIKOM Bali',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'UKM Bela Diri Shorinji Kempo',
            'jenis' => 'UKM',
            'deskripsi' => 'UKM Bela Diri Shorinji Kempo',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'UKM Wira Usaha',
            'jenis' => 'UKM',
            'deskripsi' => 'UKM Wira Usaha',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'UKM Badminton of STMIK STIKOM Bali (BOSS)',
            'jenis' => 'UKM',
            'deskripsi' => 'UKM Badminton of STMIK STIKOM Bali (BOSS)',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'UKM Bali Futsal Club',
            'jenis' => 'UKM',
            'deskripsi' => 'UKM Bali Futsal Club',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'UKM Basket',
            'jenis' => 'UKM',
            'deskripsi' => 'UKM Basket',
            'tahun_berdiri' => rand(2000, 2016),
            ],
            [
            'nama_organisasi' => 'UKM Paskamras',
            'jenis' => 'UKM',
            'deskripsi' => 'UKM Paskamras',
            'tahun_berdiri' => rand(2000, 2016),
            ],
        ]);
      

        // Ambil organisasi
        $organisasi1 = \App\Models\Organisasi::where('nama_organisasi', 'Progress')->first();
        $organisasi2 = \App\Models\Organisasi::where('nama_organisasi', 'Syntax')->first();
        $organisasi3 = \App\Models\Organisasi::where('nama_organisasi', 'Himatography')->first();

        


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
