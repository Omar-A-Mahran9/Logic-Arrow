<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InquiryTest extends TestCase
{
    use RefreshDatabase;

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Mona Hassan',
            'company' => 'Heliopolis Club',
            'phone' => '+20 100 123 4567',
            'email' => 'mona@example.com',
            'service' => 'apps',
            'message' => 'We want a member app for renewals.',
            'locale' => 'ar',
        ], $overrides);
    }

    public function test_website_form_creates_an_inquiry(): void
    {
        $this->postJson('/api/inquiries', $this->payload())->assertCreated();

        $this->assertDatabaseHas('inquiries', [
            'email' => 'mona@example.com',
            'company' => 'Heliopolis Club',
            'service' => 'apps',
            'locale' => 'ar',
        ]);
    }

    public function test_company_and_service_are_optional(): void
    {
        $this->postJson('/api/inquiries', $this->payload(['company' => null, 'service' => null]))->assertCreated();
    }

    public function test_unknown_service_and_bad_fields_are_rejected(): void
    {
        $this->postJson('/api/inquiries', $this->payload(['service' => 'crypto', 'email' => 'nope', 'phone' => 'abc']))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['service', 'email', 'phone']);
    }

    public function test_honeypot_blocks_bots(): void
    {
        $this->postJson('/api/inquiries', $this->payload(['website' => 'spam.example']))->assertStatus(422);
        $this->assertDatabaseCount('inquiries', 0);
    }

    public function test_dashboard_requires_login(): void
    {
        $this->get('/admin/inquiries')->assertRedirect('/login');
    }

    public function test_admin_can_filter_by_service_and_open_an_inquiry(): void
    {
        $admin = User::factory()->create();
        $app = Inquiry::create($this->payload());
        Inquiry::create($this->payload(['name' => 'Karim Adel', 'service' => 'ai']));

        $this->actingAs($admin)->get('/admin/inquiries?service=apps')
            ->assertOk()
            ->assertSee('Mona Hassan')
            ->assertDontSee('Karim Adel');

        $this->actingAs($admin)->get("/admin/inquiries/{$app->id}")
            ->assertOk()
            ->assertSee('Heliopolis Club')
            ->assertSee(Inquiry::SERVICES['apps']);

        $this->assertNotNull($app->fresh()->read_at);
    }
}
