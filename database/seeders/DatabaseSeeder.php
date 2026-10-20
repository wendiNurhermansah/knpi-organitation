<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Aspiration;
use App\Models\Category;
use App\Models\Event;
use App\Models\Official;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database according to SRS, ERD, and UI specifications.
     */
    public function run(): void
    {
        // 1. Seed Default Users with Roles
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@knpi.or.id'],
            [
                'name' => 'Super Administrator KNPI',
                'password' => Hash::make('password123'),
                'role' => 'super_admin',
                'email_verified_at' => now(),
            ]
        );

        $adminHumas = User::firstOrCreate(
            ['email' => 'humas@knpi.or.id'],
            [
                'name' => 'Tim Humas & Media DPP KNPI',
                'password' => Hash::make('password123'),
                'role' => 'admin_humas',
                'email_verified_at' => now(),
            ]
        );

        $adminOkp = User::firstOrCreate(
            ['email' => 'okp@knpi.or.id'],
            [
                'name' => 'Koordinator Verifikasi OKP',
                'password' => Hash::make('password123'),
                'role' => 'admin_okp',
                'email_verified_at' => now(),
            ]
        );

        // 2. Seed Default Article Categories
        $categoriesData = [
            [
                'name' => 'Ketenagakerjaan',
                'slug' => 'ketenagakerjaan',
                'description' => 'Isu ketenagakerjaan pemuda, vokasi, bursa kerja, dan kesiapan pasar kerja global.',
            ],
            [
                'name' => 'Kepemudaan',
                'slug' => 'kepemudaan',
                'description' => 'Aktivitas kepemudaan, kaderisasi, kepemimpinan, dan pergerakan organisasi pemuda nasional.',
            ],
            [
                'name' => 'Sosial Budaya',
                'slug' => 'sosial-budaya',
                'description' => 'Penguatan persatuan, kearifan lokal, advokasi kemanusiaan, dan toleransi kebangsaan.',
            ],
            [
                'name' => 'Wirausaha',
                'slug' => 'wirausaha',
                'description' => 'Pengembangan ekonomi kreatif, inkubasi bisnis rintisan pemuda, dan digital marketing.',
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $data) {
            $categories[$data['slug']] = Category::firstOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        // 3. Seed 5 Dummy OKP Records (Mix of verified and pending)
        $okps = [
            [
                'name' => 'Pemuda Pancasila',
                'slug' => 'pemuda-pancasila',
                'leader_name' => 'Japto Soerjosoemarno',
                'email' => 'dpp@pemudapancasila.or.id',
                'phone' => '081234567801',
                'sk_number' => 'AHU-0012948.AH.01.07.TAHUN.2024',
                'period_start' => '2024-01-01',
                'period_end' => '2027-12-31',
                'status' => 'verified',
            ],
            [
                'name' => 'Gerakan Pemuda Ansor (GP Ansor)',
                'slug' => 'gp-ansor',
                'leader_name' => 'Addin Jauharudin',
                'email' => 'sekretariat@ansor.id',
                'phone' => '081234567802',
                'sk_number' => 'AHU-0008472.AH.01.07.TAHUN.2024',
                'period_start' => '2024-02-01',
                'period_end' => '2027-02-01',
                'status' => 'verified',
            ],
            [
                'name' => 'Pemuda Muhammadiyah',
                'slug' => 'pemuda-muhammadiyah',
                'leader_name' => 'Dzulfikar Ahmad Tawalla',
                'email' => 'info@pemudamuhammadiyah.org',
                'phone' => '081234567803',
                'sk_number' => 'AHU-0003189.AH.01.07.TAHUN.2023',
                'period_start' => '2023-03-01',
                'period_end' => '2027-03-01',
                'status' => 'verified',
            ],
            [
                'name' => 'Angkatan Muda Pembaharuan Indonesia (AMPI)',
                'slug' => 'ampi',
                'leader_name' => 'Jerry Sambuaga',
                'email' => 'kontak@dpp-ampi.org',
                'phone' => '081234567804',
                'sk_number' => 'SK-DPD-KNPI/V/2026-088',
                'period_start' => '2026-01-15',
                'period_end' => '2029-01-15',
                'status' => 'pending',
            ],
            [
                'name' => 'Garda Bangsa',
                'slug' => 'garda-bangsa',
                'leader_name' => 'Tommy Kurniawan',
                'email' => 'sekretariat@gardabangsa.id',
                'phone' => '081234567805',
                'sk_number' => 'SK-DPD-KNPI/IX/2026-112',
                'period_start' => '2026-06-01',
                'period_end' => '2029-06-01',
                'status' => 'pending',
            ],
        ];

        foreach ($okps as $okpData) {
            Organization::firstOrCreate(
                ['slug' => $okpData['slug']],
                $okpData
            );
        }

        // 4. Seed Articles (News Matching UI Wireframe)
        $articles = [
            [
                'title' => 'Sinergi Pemuda, Membangun Bangsa Menuju Indonesia Emas 2045',
                'slug' => 'sinergi-pemuda-membangun-bangsa-menuju-indonesia-emas-2045',
                'category_id' => $categories['kepemudaan']->id,
                'user_id' => $adminHumas->id,
                'summary' => 'KNPI mempertegas peranan strategis generasi muda dalam mengakselerasi transformasi digital dan kedaulatan ekonomi kerakyatan menuju peradaban Indonesia Emas.',
                'content' => '<p>Generasi muda adalah pilar utama pembangunan nasional. Dalam menghadapi era disrupsi teknologi dan bonus demografi, Komite Nasional Pemuda Indonesia (KNPI) terus menggalang sinergi lintas OKP dan komunitas pemuda di seluruh penjuru Tanah Air.</p><p>Ketua Umum KNPI menegaskan bahwa persatuan pemuda adalah kunci utama dalam menjaga kedaulatan bangsa dan memajukan daya saing global.</p>',
                'status' => 'published',
                'views_count' => 1420,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Sinergi Pesisir: Pelatihan Akselerasi Wirausaha Bahari Pemuda',
                'slug' => 'sinergi-pesisir-pelatihan-akselerasi-wirausaha-bahari-pemuda',
                'category_id' => $categories['wirausaha']->id,
                'user_id' => $adminHumas->id,
                'summary' => 'Kolaborasi KNPI bersama Kementerian Kelautan mendorong pemuda pesisir memanfaatkan platform e-commerce dan rantai pasok maritim terintegrasi.',
                'content' => '<p>Potensi maritim Indonesia memerlukan sentuhan inovasi pemuda. Melalui program Inkubasi Wirausaha Bahari, puluhan delegasi pemuda pesisir diberikan pendampingan manajemen bisnis dan akses permodalan terpadu.</p>',
                'status' => 'published',
                'views_count' => 850,
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'Suara Siasat Pemuda Tangguh: Pulihkan Menuju Indonesia Emas',
                'slug' => 'suara-siasat-pemuda-tangguh-pulihkan-menuju-indonesia-emas',
                'category_id' => $categories['ketenagakerjaan']->id,
                'user_id' => $adminHumas->id,
                'summary' => 'Forum diskusi kebijakan ketenagakerjaan merekomendasikan perlunya reskilling masif bagi lulusan vokasi agar sesuai dengan kebutuhan industri hijau.',
                'content' => '<p>Tantangan ketenagakerjaan pasca-pandemi menuntut kesiapan pemuda dalam menguasai keterampilan masa depan (future skills). KNPI menjembatani kemitraan antara asosiasi industri dengan sentra vokasi kepemudaan.</p>',
                'status' => 'published',
                'views_count' => 670,
                'published_at' => now()->subDays(6),
            ],
        ];

        foreach ($articles as $art) {
            Article::firstOrCreate(
                ['slug' => $art['slug']],
                $art
            );
        }

        // 5. Seed Events / Agenda
        $events = [
            [
                'title' => 'Rapat Pimpinan Nasional (RAPIMNAS) Pemuda Indonesia 2026',
                'slug' => 'rapimnas-pemuda-indonesia-2026',
                'description' => 'Musyawarah koordinasi pimpinan organisasi kepemudaan nasional untuk menyelaraskan cetak biru gerakan kepemudaan dan strategi kemitraan pembangunan.',
                'location' => 'Grand Ballroom Hotel Indonesia Kempinski, Jakarta Pusat',
                'start_time' => now()->addDays(5)->setHour(9)->setMinute(0),
                'end_time' => now()->addDays(7)->setHour(17)->setMinute(0),
                'quota' => 250,
                'is_open_registration' => true,
            ],
            [
                'title' => 'Workshop Digital Youth Leadership & AI Literacy',
                'slug' => 'workshop-digital-youth-leadership-ai-literacy',
                'description' => 'Pelatihan intensif pemanfaatan kecerdasan buatan, etika digital, dan manajemen advokasi publik untuk pengurus OKP tingkat pusat dan daerah.',
                'location' => 'Auditorium Graha Pemuda DPP KNPI, Jl. HR Rasuna Said, Jakarta',
                'start_time' => now()->addDays(12)->setHour(8)->setMinute(30),
                'end_time' => now()->addDays(13)->setHour(16)->setMinute(0),
                'quota' => 150,
                'is_open_registration' => true,
            ],
        ];

        foreach ($events as $ev) {
            Event::firstOrCreate(
                ['slug' => $ev['slug']],
                $ev
            );
        }

        // 6. Seed Dummy Aspirations
        $aspirations = [
            [
                'ticket_code' => 'KNPI-202610-A91B',
                'sender_name' => 'Rizky Ramadhan',
                'sender_email' => 'rizky.ramadhan@gmail.com',
                'category' => 'Ketenagakerjaan',
                'subject' => 'Permohonan Sertifikasi BNSP Gratis untuk Pemuda Vokasi',
                'message' => 'Mohon difasilitasi program sertifikasi kompetensi gratis bagi fresh graduate SMK di wilayah Jawa Barat agar mempercepat serapan kerja.',
                'status' => 'submitted',
                'admin_notes' => null,
            ],
            [
                'ticket_code' => 'KNPI-202610-K83C',
                'sender_name' => 'Fadhilah Nurul Insani',
                'sender_email' => 'fadhilah.insani@yahoo.com',
                'category' => 'Kepemudaan',
                'subject' => 'Penyediaan Ruang Kreatif Pemuda di Daerah Pelosok',
                'message' => 'Kami mengusulkan pendirian Youth Hub atau ruang ekspresi seni dan teknologi di Kabupaten Sukabumi Selatan agar pemuda tidak terjerumus hal negatif.',
                'status' => 'in_review',
                'admin_notes' => 'Aspirasi telah diteruskan ke Departemen Seni Budaya & Olahraga DPP KNPI untuk dijajaki bersama Dispora setempat.',
                'handled_by' => $superAdmin->id,
            ],
            [
                'ticket_code' => 'KNPI-202610-W12D',
                'sender_name' => 'Bagus Wicaksono',
                'sender_email' => 'bagus.wicak@outlook.com',
                'category' => 'Wirausaha',
                'subject' => 'Akses Permodalan UMKM Pemuda Berbasis KUR',
                'message' => 'Kendala utama wirausaha muda adalah agunan bank saat mengajukan KUR. Mohon KNPI dapat menjadi agregator atau penjamin kemitraan.',
                'status' => 'resolved',
                'admin_notes' => 'Telah dihubungkan dengan program Inkubasi Bisnis Wirausaha Muda KNPI bekerjasama dengan Bank Himbara. Silakan cek email berkala.',
                'handled_by' => $adminHumas->id,
            ],
        ];

        foreach ($aspirations as $asp) {
            Aspiration::firstOrCreate(
                ['ticket_code' => $asp['ticket_code']],
                $asp
            );
        }

        // 7. Seed Official Leadership (Dewan Pengurus)
        $officials = [
            [
                'name' => 'M. Ryano Panjaitan',
                'position' => 'Ketua Umum DPP KNPI',
                'department' => 'Dewan Pengurus Pusat',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Sekretaris Jenderal DPP KNPI',
                'position' => 'Sekretaris Jenderal',
                'department' => 'Dewan Pengurus Pusat',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Bendahara Umum DPP KNPI',
                'position' => 'Bendahara Umum',
                'department' => 'Dewan Pengurus Pusat',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($officials as $off) {
            Official::firstOrCreate(
                ['name' => $off['name']],
                $off
            );
        }
    }
}
