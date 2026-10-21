<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Aspiration;
use App\Models\Category;
use App\Models\Event;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KnpiEcosystemTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test public landing page loads properly.
     */
    public function test_landing_page_renders_with_hero_and_metrics(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Sinergi Pemuda');
        $response->assertSee('Membangun Bangsa');
        $response->assertSee('Indonesia Emas');
        $response->assertSee('e-Aspirasi Pemuda');
    }

    /**
     * Test public news articles listing and detail view.
     */
    public function test_public_articles_index_and_show(): void
    {
        $article = Article::where('status', 'published')->first();

        $indexResponse = $this->get('/berita');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee($article->title);

        $showResponse = $this->get('/berita/' . $article->slug);
        $showResponse->assertStatus(200);
        $showResponse->assertSee($article->title);
    }

    /**
     * Test public OKP directory showcase.
     */
    public function test_public_okp_directory(): void
    {
        $response = $this->get('/okp');

        $response->assertStatus(200);
        $response->assertSee('Direktori OKP Terdaftar');
        $response->assertSee('Terverifikasi');
    }

    /**
     * Test public youth agenda listing and participant registration.
     */
    public function test_agenda_listing_and_registration(): void
    {
        $event = Event::first();

        $response = $this->get('/agenda');
        $response->assertStatus(200);
        $response->assertSee($event->title);

        $regResponse = $this->post("/agenda/{$event->id}/register", [
            'name' => 'Budi Santoso',
            'nik' => '3201123456789012',
            'email' => 'budi.santoso@example.com',
            'phone' => '081298765432',
            'okp_origin' => 'Gerakan Mahasiswa Nasional Indonesia (GMNI)',
        ]);

        $regResponse->assertSessionHas('success');
        $this->assertDatabaseHas('event_registrations', [
            'event_id' => $event->id,
            'name' => 'Budi Santoso',
            'nik' => '3201123456789012',
        ]);
    }

    /**
     * Test public e-aspirasi submission and tracking.
     */
    public function test_aspiration_submission_generates_ticket_and_tracks(): void
    {
        $postData = [
            'sender_name' => 'Ahmad Fauzi',
            'sender_email' => 'ahmad.fauzi@example.com',
            'category' => 'Wirausaha',
            'subject' => 'Permohonan Inkubasi Startup Pemuda Daerah',
            'message' => 'Kami dari komunitas pemuda pegiat teknologi mengusulkan adanya program pendampingan inkubasi bisnis rintisan di tingkat DPD.',
        ];

        $response = $this->post('/aspirasi', $postData);

        $aspiration = Aspiration::where('sender_email', 'ahmad.fauzi@example.com')->first();
        $this->assertNotNull($aspiration);
        $this->assertStringStartsWith('KNPI-', $aspiration->ticket_code);

        $response->assertRedirect('/aspirasi/lacak?ticket_code=' . $aspiration->ticket_code);

        // Track the ticket
        $trackResponse = $this->get('/aspirasi/lacak?ticket_code=' . $aspiration->ticket_code);
        $trackResponse->assertStatus(200);
        $trackResponse->assertSee($aspiration->ticket_code);
        $trackResponse->assertSee('Ahmad Fauzi');
    }

    /**
     * Test Paper Admin dashboard metrics and authentication.
     */
    public function test_admin_dashboard_requires_auth_and_renders_metrics(): void
    {
        // Guest is redirected
        $guestResponse = $this->get('/admin/dashboard');
        $guestResponse->assertRedirect('/login');

        // Login as Super Admin
        $user = User::where('role', 'super_admin')->first();
        $this->actingAs($user);

        // Default Indonesian
        $adminResponse = $this->get('/admin/dashboard');
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Verifikasi OKP Terkini');
        $adminResponse->assertSee('Tiket Aspirasi Aktif');

        // English switch
        $adminEnResponse = $this->withSession(['locale' => 'en'])->get('/admin/dashboard');
        $adminEnResponse->assertStatus(200);
        $adminEnResponse->assertSee('Recent OKP Verification');
        $adminEnResponse->assertSee('Active Youth Aspiration Tickets');
    }

    /**
     * Test language switcher route and session persistence.
     */
    public function test_language_switcher_route_and_switching(): void
    {
        // Switch to English
        $switchResponse = $this->get('/lang/en');
        $switchResponse->assertSessionHas('locale', 'en');

        // Verify English content and dynamic translated database records on home page
        $enPage = $this->withSession(['locale' => 'en'])->get('/');
        $enPage->assertStatus(200);
        // Section Headers
        $enPage->assertSee('Youth Synergy');
        $enPage->assertSee('Building the Nation');
        $enPage->assertSee('Featured Youth News');
        $enPage->assertSee('Registered OKP Directory');
        $enPage->assertSee('Upcoming Youth Events');
        // Dynamic Article content in English
        $enPage->assertSee('Youth Synergy, Building the Nation Towards Golden Indonesia 2045');
        $enPage->assertSee('KNPI underscores the strategic role of youth');
        // Dynamic Event content in English
        $enPage->assertSee('National Leadership Meeting (RAPIMNAS) of Indonesian Youth 2026');
        $enPage->assertSee('National youth leadership assembly');

        // Switch back to Indonesian
        $switchId = $this->get('/lang/id');
        $switchId->assertSessionHas('locale', 'id');

        // Verify Indonesian content and dynamic database records on home page
        $idPage = $this->withSession(['locale' => 'id'])->get('/');
        $idPage->assertStatus(200);
        // Section Headers
        $idPage->assertSee('Sinergi Pemuda');
        $idPage->assertSee('Membangun Bangsa');
        $idPage->assertSee('Warta Pemuda Pilihan');
        $idPage->assertSee('Direktori OKP Terdaftar');
        $idPage->assertSee('Agenda Pemuda Mendatang');
        // Dynamic Article content in Indonesian
        $idPage->assertSee('Sinergi Pemuda, Membangun Bangsa Menuju Indonesia Emas 2045');
        $idPage->assertSee('KNPI mempertegas peranan strategis generasi muda');
        // Dynamic Event content in Indonesian
        $idPage->assertSee('Rapat Pimpinan Nasional (RAPIMNAS) Pemuda Indonesia 2026');
        $idPage->assertSee('Musyawarah koordinasi pimpinan organisasi kepemudaan nasional');
    }

    /**
     * Test Admin OKP verification custom action PATCH /admin/okp/{organization}/verify.
     */
    public function test_admin_can_verify_okp(): void
    {
        $user = User::where('role', 'super_admin')->first();
        $this->actingAs($user);

        $pendingOrg = Organization::where('status', 'pending')->first();

        $patchResponse = $this->patch("/admin/okp/{$pendingOrg->id}/verify", [
            'status' => 'verified',
            'sk_number' => 'SK-DPP-KNPI/TEST/2026',
            'period_start' => '2026-01-01',
            'period_end' => '2029-01-01',
        ]);

        $patchResponse->assertSessionHas('success');
        $this->assertEquals('verified', $pendingOrg->fresh()->status);
        $this->assertEquals('SK-DPP-KNPI/TEST/2026', $pendingOrg->fresh()->sk_number);
    }

    /**
     * Test Admin Aspiration management and response.
     */
    public function test_admin_can_update_aspiration_ticket(): void
    {
        $user = User::where('role', 'super_admin')->first();
        $this->actingAs($user);

        $ticket = Aspiration::where('status', 'submitted')->first();

        $patchResponse = $this->patch("/admin/aspirasi/{$ticket->id}", [
            'status' => 'in_review',
            'admin_notes' => 'Aspirasi telah didisposisi ke Bidang Ketenagakerjaan & Vokasi DPP KNPI.',
        ]);

        $patchResponse->assertSessionHas('success');
        $this->assertEquals('in_review', $ticket->fresh()->status);
        $this->assertEquals('Aspirasi telah didisposisi ke Bidang Ketenagakerjaan & Vokasi DPP KNPI.', $ticket->fresh()->admin_notes);
        $this->assertEquals($user->id, $ticket->fresh()->handled_by);
    }

    /**
     * Test modern login page renders with Captcha challenge.
     */
    public function test_login_page_renders_with_modern_design_and_captcha(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Pusat Kendali Ekosistem Pemuda');
        $response->assertSee('Verifikasi Keamanan (Anti-Bot)');
        $response->assertSessionHas('captcha_answer');
        $response->assertSessionHas('captcha_question');
    }

    /**
     * Test login fails when captcha is invalid.
     */
    public function test_login_fails_with_invalid_captcha(): void
    {
        $this->get('/login');

        $response = $this->post('/login', [
            'email' => 'admin@knpi.or.id',
            'password' => 'password123',
            'captcha' => 9999, // wrong captcha answer
        ]);

        $response->assertSessionHasErrors('captcha');
        $this->assertGuest();
    }

    /**
     * Test login succeeds when valid captcha is provided.
     */
    public function test_login_succeeds_with_valid_captcha(): void
    {
        $this->get('/login');
        $correctAnswer = session('captcha_answer');

        $response = $this->post('/login', [
            'email' => 'admin@knpi.or.id',
            'password' => 'password123',
            'captcha' => $correctAnswer,
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticated();
    }

    /**
     * Test dynamic captcha refresh endpoint.
     */
    public function test_captcha_refresh_endpoint(): void
    {
        $response = $this->getJson('/captcha/refresh');

        $response->assertStatus(200);
        $response->assertJsonStructure(['question']);
        $this->assertNotNull(session('captcha_answer'));
    }
}
