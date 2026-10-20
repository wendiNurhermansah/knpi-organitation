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

        $adminResponse = $this->get('/admin/dashboard');
        $adminResponse->assertStatus(200);
        $adminResponse->assertSee('Recent OKP Verification');
        $adminResponse->assertSee('Active Youth Aspiration Ticket');
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
}
