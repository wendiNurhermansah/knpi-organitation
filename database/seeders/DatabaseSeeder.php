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

        // 3. Seed Registered OKP Directory (10 National Youth Organizations)
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
                'name' => 'Gerakan Mahasiswa Nasional Indonesia (GMNI)',
                'slug' => 'gmni',
                'leader_name' => 'Imanuel Cahyadi',
                'email' => 'dpp@gmni.or.id',
                'phone' => '081234567806',
                'sk_number' => 'AHU-0001928.AH.01.07.TAHUN.2024',
                'period_start' => '2024-05-01',
                'period_end' => '2027-05-01',
                'status' => 'verified',
            ],
            [
                'name' => 'Himpunan Mahasiswa Islam (HMI)',
                'slug' => 'hmi',
                'leader_name' => 'Bagis Pratama',
                'email' => 'pbhmi@hmi.or.id',
                'phone' => '081234567807',
                'sk_number' => 'AHU-0004921.AH.01.07.TAHUN.2024',
                'period_start' => '2024-01-10',
                'period_end' => '2026-12-31',
                'status' => 'verified',
            ],
            [
                'name' => 'Pergerakan Mahasiswa Islam Indonesia (PMII)',
                'slug' => 'pmii',
                'leader_name' => 'M. Shofiyullah Cokro',
                'email' => 'pb@pmii.id',
                'phone' => '081234567808',
                'sk_number' => 'AHU-0007812.AH.01.07.TAHUN.2024',
                'period_start' => '2024-08-01',
                'period_end' => '2027-08-01',
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
            [
                'name' => 'Ikatan Mahasiswa Muhammadiyah (IMM)',
                'slug' => 'imm',
                'leader_name' => 'Riyan Betra Delza',
                'email' => 'dpp@imm.or.id',
                'phone' => '081234567809',
                'sk_number' => 'AHU-0005234.AH.01.07.TAHUN.2024',
                'period_start' => '2024-03-01',
                'period_end' => '2026-03-01',
                'status' => 'verified',
            ],
            [
                'name' => 'Kesatuan Aksi Mahasiswa Muslim Indonesia (KAMMI)',
                'slug' => 'kammi',
                'leader_name' => 'Ahmad Jundi Muzakki',
                'email' => 'pengurus@kammi.id',
                'phone' => '081234567810',
                'sk_number' => 'SK-DPD-KNPI/XI/2026-045',
                'period_start' => '2026-02-01',
                'period_end' => '2028-02-01',
                'status' => 'pending',
            ],
        ];

        foreach ($okps as $okpData) {
            Organization::firstOrCreate(
                ['slug' => $okpData['slug']],
                $okpData
            );
        }

        // 4. Seed Featured Youth News (Articles Matching UI Wireframe)
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
            [
                'title' => 'DPP KNPI Luncurkan Sentra Inkubasi Start-Up Pemuda Daerah',
                'slug' => 'dpp-knpi-luncurkan-sentra-inkubasi-start-up-pemuda-daerah',
                'category_id' => $categories['wirausaha']->id,
                'user_id' => $adminHumas->id,
                'summary' => 'Program pendampingan dan modal hibah bagi 100 inisiator bisnis rintisan pemuda di 38 provinsi diresmikan oleh pimpinan DPP KNPI.',
                'content' => '<p>Kemandirian ekonomi generasi muda menjadi fokus fundamental. Dengan dibukanya sentra inkubasi ini, pengusaha muda mendapatkan bimbingan mentor dan akses pendanaan ventura.</p>',
                'status' => 'published',
                'views_count' => 1120,
                'published_at' => now()->subDays(8),
            ],
            [
                'title' => 'Dialog Kebangsaan: Memperkokoh Toleransi & Karakter Pemuda',
                'slug' => 'dialog-kebangsaan-memperkokoh-toleransi-karakter-pemuda',
                'category_id' => $categories['sosial-budaya']->id,
                'user_id' => $adminHumas->id,
                'summary' => 'Menghadirkan tokoh lintas agama dan budayawan, KNPI mengukuhkan komitmen pemuda sebagai garda terdepan penjaga keutuhan NKRI.',
                'content' => '<p>Keberagaman suku, ras, dan agama adalah kekayaan bangsa yang harus dirawat oleh generasi penerus. Forum ini menghasilkan deklarasi pemuda damai menyongsong agenda kebangsaan 2026-2029.</p>',
                'status' => 'published',
                'views_count' => 930,
                'published_at' => now()->subDays(10),
            ],
        ];

        foreach ($articles as $art) {
            Article::firstOrCreate(
                ['slug' => $art['slug']],
                $art
            );
        }

        // 5. Seed Upcoming Youth Events (Scheduled in the near future)
        $events = [
            [
                'title' => 'Rapat Pimpinan Nasional (RAPIMNAS) Pemuda Indonesia 2026',
                'slug' => 'rapimnas-pemuda-indonesia-2026',
                'description' => 'Musyawarah koordinasi pimpinan organisasi kepemudaan nasional untuk menyelaraskan cetak biru gerakan kepemudaan dan strategi kemitraan pembangunan nasional.',
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
            [
                'title' => 'Festival Wirausaha Kreatif Pemuda Nusantara 2026',
                'slug' => 'festival-wirausaha-kreatif-pemuda-nusantara-2026',
                'description' => 'Eksibisi produk inovasi wirausaha muda, temu investor, serta bazaar UMKM binaan DPD KNPI se-Indonesia.',
                'location' => 'Plaza Selatan Gelora Bung Karno (GBK), Senayan, Jakarta',
                'start_time' => now()->addDays(18)->setHour(10)->setMinute(0),
                'end_time' => now()->addDays(20)->setHour(21)->setMinute(0),
                'quota' => 500,
                'is_open_registration' => true,
            ],
            [
                'title' => 'Forum Dialog Ketenagakerjaan & Sertifikasi Vokasi',
                'slug' => 'forum-dialog-ketenagakerjaan-sertifikasi-vokasi',
                'description' => 'Konsultasi publik bersama Kementerian Ketenagakerjaan dan BNSP untuk akselerasi sertifikasi gratis bagi lulusan baru.',
                'location' => 'Gedung Vokasi Kemenaker, Jl. Gatot Subroto, Jakarta Selatan',
                'start_time' => now()->addDays(25)->setHour(9)->setMinute(0),
                'end_time' => now()->addDays(25)->setHour(15)->setMinute(30),
                'quota' => 200,
                'is_open_registration' => true,
            ],
        ];

        foreach ($events as $ev) {
            Event::firstOrCreate(
                ['slug' => $ev['slug']],
                $ev
            );
        }

        // 6. Seed Youth Aspirations
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
