<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Bank;
use App\Models\Pengumuman;
use App\Models\Departement;
use App\Models\Menu;
use App\Models\Pengurus;
use App\Models\SubMenu;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //



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


        // Ambil organisasi sesuai data yang di-insert di atas
        $organisasi1 = \App\Models\Organisasi::where('nama_organisasi', 'UKM Programmer (Progress)')->first();
        $organisasi2 = \App\Models\Organisasi::where('nama_organisasi', 'UKM Multimedia')->first();
        $organisasi3 = \App\Models\Organisasi::where('nama_organisasi', 'Himatography (Himpunan Mahasiswa Photography STIKOM Bali)')->first();
        $organisasi4 = \App\Models\Organisasi::where('nama_organisasi', 'Senat Mahasiswa STIKOM Bali')->first();
        $organisasi5 = \App\Models\Organisasi::where('nama_organisasi', 'UKM Robotic')->first();
        $organisasi6 = \App\Models\Organisasi::where('nama_organisasi', 'Komunitas Linux STIKOM Bali')->first();
        $organisasi7 = \App\Models\Organisasi::where('nama_organisasi', 'UKM Modern Dance')->first();
        $organisasi8 = \App\Models\Organisasi::where('nama_organisasi', 'UKM Basket')->first();
        $organisasi9 = \App\Models\Organisasi::where('nama_organisasi', 'Voice of STIKOM Bali (VOS)')->first();

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
            [
                'id_organisasi' => $organisasi4->id_organisasi,
                'nama_kegiatan' => 'Rapat Kerja Tahunan',
                'deskripsi' => 'Rapat kerja tahunan Senat Mahasiswa STIKOM Bali.',
                'tanggal_pelaksanaan' => now()->addDays(10)->toDateString(),
                'kuota_peserta' => 30,
                'lokasi' => 'Ruang Rapat Senat',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => $organisasi5->id_organisasi,
                'nama_kegiatan' => 'Kompetisi Robotik Internal',
                'deskripsi' => 'Kompetisi robotik antar anggota UKM Robotic.',
                'tanggal_pelaksanaan' => now()->addDays(12)->toDateString(),
                'kuota_peserta' => 20,
                'lokasi' => 'Lab Robotik',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => $organisasi6->id_organisasi,
                'nama_kegiatan' => 'Pelatihan Linux Dasar',
                'deskripsi' => 'Pelatihan penggunaan Linux untuk pemula.',
                'tanggal_pelaksanaan' => now()->addDays(15)->toDateString(),
                'kuota_peserta' => 25,
                'lokasi' => 'Ruang Komunitas Linux',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => $organisasi7->id_organisasi,
                'nama_kegiatan' => 'Latihan Tari Modern',
                'deskripsi' => 'Latihan rutin UKM Modern Dance.',
                'tanggal_pelaksanaan' => now()->addDays(18)->toDateString(),
                'kuota_peserta' => 35,
                'lokasi' => 'Studio Tari',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => $organisasi8->id_organisasi,
                'nama_kegiatan' => 'Turnamen Basket Internal',
                'deskripsi' => 'Turnamen basket antar anggota UKM Basket.',
                'tanggal_pelaksanaan' => now()->addDays(20)->toDateString(),
                'kuota_peserta' => 24,
                'lokasi' => 'Lapangan Basket STIKOM',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => $organisasi9->id_organisasi,
                'nama_kegiatan' => 'Pelatihan Public Speaking',
                'deskripsi' => 'Pelatihan public speaking untuk anggota VOS.',
                'tanggal_pelaksanaan' => now()->addDays(22)->toDateString(),
                'kuota_peserta' => 30,
                'lokasi' => 'Ruang VOS',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $namaDepan = ['Budi', 'Siti', 'Agus', 'Dewi', 'Rizki', 'Putri', 'Andi', 'Rina', 'Joko', 'Ayu', 'Dian', 'Bayu', 'Wulan', 'Fajar', 'Lestari', 'Yoga', 'Indah', 'Rizka', 'Dimas', 'Nia'];
        $namaBelakang = ['Santoso', 'Wijaya', 'Saputra', 'Sari', 'Pratama', 'Utami', 'Hidayat', 'Permata', 'Setiawan', 'Rahmawati', 'Susanto', 'Putra', 'Putri', 'Wibowo', 'Anggraini', 'Kusuma', 'Ramadhan', 'Maulana', 'Puspita', 'Syahputra'];
        $prodis = ['Sistem Informasi', 'Teknik Informatika', 'Manajemen Informatika', 'Sistem Komputer', 'Teknologi Informasi'];

        $orgProgress = \App\Models\Organisasi::where('nama_organisasi', 'UKM Programmer (Progress)')->first();
        $orgLinux = \App\Models\Organisasi::where('nama_organisasi', 'Komunitas Linux STIKOM Bali')->first();
        $orgMultimedia = \App\Models\Organisasi::where('nama_organisasi', 'UKM Multimedia')->first();

        // Buat 20 user yang join ke 3 organisasi tersebut
        for ($i = 1; $i <= 20; $i++) {
            $namaDepanRand = $namaDepan[array_rand($namaDepan)];
            $namaBelakangRand = $namaBelakang[array_rand($namaBelakang)];
            $nama = "$namaDepanRand $namaBelakangRand";
            $prodi = $prodis[array_rand($prodis)];
            $email = strtolower(str_replace(' ', '.', $nama)) . $i . '@mail.com';
            $nim = rand(210000000, 210099999);
            $no_hp = '08123' . rand(1000000, 9999999);

            $user = \App\Models\User::create([
                'name' => $nama,
                'email' => $email,
                'password' => bcrypt('anggota123'),
            ]);
            $user->assignRole('anggota');

            $dataAnggota = [
                'id_user' => $user->id,
                'nama' => $nama,
                'nim' => $nim,
                'no_hp' => $no_hp,
                'prodi' => $prodi,
                'tanggal_gabung' => now(),
                'status_keanggotaan' => 'aktif',
            ];

            foreach ([$orgProgress, $orgLinux, $orgMultimedia] as $org) {
                \App\Models\Anggota::create(array_merge($dataAnggota, [
                    'id_organisasi' => $org->id_organisasi
                ]));
            }
        }

        // Ambil organisasi lain
        $otherOrgs = \App\Models\Organisasi::whereNotIn('id_organisasi', [
            $orgProgress->id_organisasi,
            $orgLinux->id_organisasi,
            $orgMultimedia->id_organisasi,
        ])->get();

        // Buat 10 user, masing-masing join ke 2 organisasi random dari selain 3 di atas
        for ($i = 1; $i <= 10; $i++) {
            $namaDepanRand = $namaDepan[array_rand($namaDepan)];
            $namaBelakangRand = $namaBelakang[array_rand($namaBelakang)];
            $nama = "$namaDepanRand $namaBelakangRand";
            $prodi = $prodis[array_rand($prodis)];
            $email = strtolower(str_replace(' ', '.', $nama)) . 'lain' . $i . '@mail.com';
            $nim = rand(210100000, 210199999);
            $no_hp = '08213' . rand(1000000, 9999999);

            $user = \App\Models\User::create([
                'name' => $nama,
                'email' => $email,
                'password' => bcrypt('anggota123'),
            ]);
            $user->assignRole('anggota');

            $dataAnggota = [
                'id_user' => $user->id,
                'nama' => $nama,
                'nim' => $nim,
                'no_hp' => $no_hp,
                'prodi' => $prodi,
                'tanggal_gabung' => now(),
                'status_keanggotaan' => 'aktif',
            ];

            $orgs = $otherOrgs->random(2);

            foreach ($orgs as $org) {
                \App\Models\Anggota::create(array_merge($dataAnggota, [
                    'id_organisasi' => $org->id_organisasi
                ]));
            }
        }


        $jabatanList = ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Koordinator', 'Anggota Inti'];

        $periodeMulai = Carbon::create(2023, 1, 1);
        $periodeAkhir = Carbon::create(2023, 12, 31);

        // Loop untuk semua organisasi (1 - 26)
        for ($orgId = 1; $orgId <= 26; $orgId++) {
            // Ambil semua anggota di organisasi ini
            $anggotaOrganisasi = Anggota::where('id_organisasi', $orgId)->inRandomOrder()->limit(3)->get();

            foreach ($anggotaOrganisasi as $anggota) {
                $jabatan = $jabatanList[array_rand($jabatanList)];

                // Pastikan relasi ke user tersedia
                $user = $anggota->user;
                if ($user) {
                    $user->syncRoles(['pengurus']);
                }

                // Cek apakah anggota sudah jadi pengurus untuk organisasi ini
                $existing = Pengurus::where('id_anggota', $anggota->id_anggota)->first();
                if (!$existing) {
                    Pengurus::create([
                        'id_anggota' => $anggota->id_anggota,
                        'jabatan' => $jabatan,
                        'periode_mulai' => $periodeMulai,
                        'periode_akhir' => $periodeAkhir,
                    ]);
                }
            }
        }


        // Seed Bank
        Bank::insert([
            [
                'id_organisasi' => 8, // UKM Programmer (Progress)
                'nama_bank' => 'Bank BNI Progress',
                'nomor_rekening' => '111001001',
                'atas_nama' => 'UKM Progress',
                'nominal' => 500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => 1, // Senat Mahasiswa
                'nama_bank' => 'Kas Senat STIKOM',
                'nomor_rekening' => '111001002',
                'atas_nama' => 'Senat Mahasiswa',
                'nominal' => 800000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => 11, // HIMAJESTIK
                'nama_bank' => 'HIMAJESTIK Account',
                'nomor_rekening' => '111001003',
                'atas_nama' => 'HIMAJESTIK',
                'nominal' => 600000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => 17, // SBMC
                'nama_bank' => 'SBMC Official',
                'nomor_rekening' => '111001004',
                'atas_nama' => 'SBMC',
                'nominal' => 450000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        Transaksi::insert([
            // Progress
            ['id_bank' => 1, 'nominal' => 100000, 'jenis_transaksi' => 'pemasukan', 'keterangan' => 'Iuran anggota', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 1, 'nominal' => 25000,  'jenis_transaksi' => 'pengeluaran', 'keterangan' => 'Beli kertas', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 1, 'nominal' => 200000, 'jenis_transaksi' => 'pemasukan', 'keterangan' => 'Dana sponsor', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 1, 'nominal' => 50000,  'jenis_transaksi' => 'pengeluaran', 'keterangan' => 'Makan rapat', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 1, 'nominal' => 100000, 'jenis_transaksi' => 'pengeluaran', 'keterangan' => 'Transport kegiatan', 'created_at' => now(), 'updated_at' => now()],

            // Senat
            ['id_bank' => 2, 'nominal' => 150000, 'jenis_transaksi' => 'pemasukan', 'keterangan' => 'Iuran tahunan', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 2, 'nominal' => 50000,  'jenis_transaksi' => 'pengeluaran', 'keterangan' => 'Cetak proposal', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 2, 'nominal' => 100000, 'jenis_transaksi' => 'pemasukan', 'keterangan' => 'Donasi alumni', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 2, 'nominal' => 30000,  'jenis_transaksi' => 'pengeluaran', 'keterangan' => 'Konsumsi rapat', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 2, 'nominal' => 100000, 'jenis_transaksi' => 'pengeluaran', 'keterangan' => 'Beli banner', 'created_at' => now(), 'updated_at' => now()],

            // HIMAJESTIK
            ['id_bank' => 3, 'nominal' => 80000,  'jenis_transaksi' => 'pemasukan', 'keterangan' => 'Penjualan majalah', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 3, 'nominal' => 30000,  'jenis_transaksi' => 'pengeluaran', 'keterangan' => 'Beli tinta printer', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 3, 'nominal' => 100000, 'jenis_transaksi' => 'pemasukan', 'keterangan' => 'Sponsor acara', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 3, 'nominal' => 40000,  'jenis_transaksi' => 'pengeluaran', 'keterangan' => 'Sewa tempat diskusi', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 3, 'nominal' => 50000,  'jenis_transaksi' => 'pengeluaran', 'keterangan' => 'Konsumsi peliputan', 'created_at' => now(), 'updated_at' => now()],

            // SBMC
            ['id_bank' => 4, 'nominal' => 120000, 'jenis_transaksi' => 'pemasukan', 'keterangan' => 'Uang kas', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 4, 'nominal' => 30000,  'jenis_transaksi' => 'pengeluaran', 'keterangan' => 'Perawatan alat musik', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 4, 'nominal' => 100000, 'jenis_transaksi' => 'pemasukan', 'keterangan' => 'Dana sponsor event', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 4, 'nominal' => 20000,  'jenis_transaksi' => 'pengeluaran', 'keterangan' => 'Cetak tiket', 'created_at' => now(), 'updated_at' => now()],
            ['id_bank' => 4, 'nominal' => 50000,  'jenis_transaksi' => 'pengeluaran', 'keterangan' => 'Snack latihan', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Seed Pengumuman
        Pengumuman::insert([
            [
                'id_organisasi' => 8,
                'judul' => 'Pendaftaran Anggota Baru Progress',
                'isi' => 'Dibuka pendaftaran anggota baru UKM Programmer (Progress). Daftar sebelum 10 September melalui website SIKOM.',
                'tanggal_post' => now()->subDays(7),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => 8,
                'judul' => 'Workshop ReactJS untuk Anggota',
                'isi' => 'Anggota Progress diundang mengikuti Workshop ReactJS pada Sabtu, 14 September. Tempat terbatas!',
                'tanggal_post' => now()->subDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => 8,
                'judul' => 'Evaluasi Internal dan Sharing Project',
                'isi' => 'Kegiatan evaluasi & sharing project Progress akan diadakan minggu depan. Wajib untuk seluruh anggota aktif.',
                'tanggal_post' => now()->subDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_organisasi' => 1,
                'judul' => 'Open Recruitment Panitia Dies Natalis',
                'isi' => 'Senat membuka kesempatan bagi anggota untuk menjadi panitia Dies Natalis STIKOM Bali.',
                'tanggal_post' => now()->subDays(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => 1,
                'judul' => 'Pelatihan Leadership Mahasiswa',
                'isi' => 'Anggota Senat diundang mengikuti pelatihan kepemimpinan yang akan dilaksanakan 18 September.',
                'tanggal_post' => now()->subDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => 1,
                'judul' => 'Rapat Koordinasi Kegiatan Semester Ganjil',
                'isi' => 'Mohon kehadiran seluruh anggota dalam rapat koordinasi kegiatan semester ganjil.',
                'tanggal_post' => now()->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_organisasi' => 11,
                'judul' => 'Pendaftaran Tim Liputan Kampus',
                'isi' => 'HIMAJESTIK membuka pendaftaran bagi anggota untuk bergabung dalam tim liputan kampus.',
                'tanggal_post' => now()->subDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => 11,
                'judul' => 'Pelatihan Dasar Jurnalistik',
                'isi' => 'Pelatihan dasar jurnalistik akan dilaksanakan pada 16 September. Terbuka untuk seluruh anggota.',
                'tanggal_post' => now()->subDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => 11,
                'judul' => 'Agenda Pemotretan dan Dokumentasi',
                'isi' => 'Anggota HIMAJESTIK diundang untuk mengikuti kegiatan dokumentasi acara kampus pada minggu ini.',
                'tanggal_post' => now()->subDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id_organisasi' => 17,
                'judul' => 'Pendaftaran Anggota Baru SBMC',
                'isi' => 'SBMC membuka pendaftaran anggota baru bagi mahasiswa yang tertarik di bidang musik.',
                'tanggal_post' => now()->subDays(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => 17,
                'judul' => 'Latihan Perdana dan Perkenalan Alat Musik',
                'isi' => 'Kegiatan latihan perdana SBMC akan dilaksanakan Jumat ini. Wajib hadir bagi anggota baru.',
                'tanggal_post' => now()->subDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_organisasi' => 17,
                'judul' => 'Persiapan Event Musik Kampus',
                'isi' => 'SBMC akan mengadakan event musik bulan depan. Dimohon anggota aktif ikut persiapan awal.',
                'tanggal_post' => now()->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
