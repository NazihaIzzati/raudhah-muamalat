<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Partner;
use App\Models\User;

class PartnerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create an admin user
        $this->admin = User::factory()->create([
            'role' => 'admin'
        ]);
    }

    /** @test */
    public function public_partners_page_displays_active_partners()
    {
        // Create some test partners
        $activePartner = Partner::factory()->create([
            'status' => 'active',
            'name' => 'Test Active Partner',
            'description' => 'This is an active partner',
            'url' => 'https://example.com'
        ]);

        $inactivePartner = Partner::factory()->create([
            'status' => 'inactive',
            'name' => 'Test Inactive Partner',
            'description' => 'This is an inactive partner'
        ]);

        // Visit the public partners page
        $response = $this->get('/partners');

        // Assert the page loads successfully
        $response->assertStatus(200);
        
        // Assert active partner is displayed
        $response->assertSee('Test Active Partner');
        $response->assertSee('This is an active partner');
        
        // Assert inactive partner is not displayed
        $response->assertDontSee('Test Inactive Partner');
    }

    /** @test */
    public function public_partners_page_shows_no_partners_message_when_empty()
    {
        // Ensure no partners exist
        Partner::query()->delete();

        // Visit the public partners page
        $response = $this->get('/partners');

        // Assert the page loads successfully
        $response->assertStatus(200);
        
        // Assert no partners message is displayed
        $response->assertSee('No Partners Available');
    }

    /** @test */
    public function admin_can_view_partners_list()
    {
        $this->actingAs($this->admin);

        $response = $this->get('/admin/partners');

        $response->assertStatus(200);
        $response->assertSee('Partners Directory');
    }

    /** @test */
    public function admin_can_create_new_partner()
    {
        $this->actingAs($this->admin);

        $partnerData = [
            'name' => 'New Test Partner',
            'description' => 'This is a test partner description',
            'url' => 'https://testpartner.com',
            'status' => 'active',
            'featured' => true,
            'display_order' => 1
        ];

        $response = $this->post('/admin/partners', $partnerData);

        $response->assertRedirect('/admin/partners');
        
        $this->assertDatabaseHas('partners', [
            'name' => 'New Test Partner',
            'status' => 'active',
            'featured' => true
        ]);
    }

    /** @test */
    public function admin_can_update_partner()
    {
        $this->actingAs($this->admin);

        $partner = Partner::factory()->create([
            'name' => 'Original Name',
            'status' => 'active'
        ]);

        $updateData = [
            'name' => 'Updated Name',
            'description' => 'Updated description',
            'url' => 'https://updated.com',
            'status' => 'active',
            'featured' => false,
            'display_order' => 5
        ];

        $response = $this->put("/admin/partners/{$partner->id}", $updateData);

        $response->assertRedirect("/admin/partners/{$partner->id}");
        
        $this->assertDatabaseHas('partners', [
            'id' => $partner->id,
            'name' => 'Updated Name',
            'description' => 'Updated description'
        ]);
    }

    /** @test */
    public function admin_can_delete_partner()
    {
        $this->actingAs($this->admin);

        $partner = Partner::factory()->create();

        $response = $this->delete("/admin/partners/{$partner->id}");

        $response->assertRedirect('/admin/partners');
        
        $this->assertDatabaseMissing('partners', [
            'id' => $partner->id
        ]);
    }

    /** @test */
    public function featured_partners_are_displayed_with_featured_badge()
    {
        // Create partners with different featured status
        $regularPartner = Partner::factory()->create([
            'status' => 'active',
            'featured' => false,
            'name' => 'Regular Partner',
            'display_order' => 1
        ]);

        $featuredPartner = Partner::factory()->create([
            'status' => 'active',
            'featured' => true,
            'name' => 'Featured Partner',
            'display_order' => 2
        ]);

        $response = $this->get('/partners');

        $response->assertStatus(200);
        
        // Check that featured partner has featured badge
        $response->assertSee('Featured Partner');
        $response->assertSee('Featured');
        
        // Check that regular partner doesn't have featured badge
        $response->assertSee('Regular Partner');
        $response->assertDontSee('Regular Partner.*Featured');
    }

    /** @test */
    public function partner_validation_works()
    {
        $this->actingAs($this->admin);

        // Try to create partner without required fields
        $response = $this->post('/admin/partners', []);

        $response->assertSessionHasErrors(['name', 'status']);
    }

    /** @test */
    public function non_admin_cannot_access_admin_partners()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user);

        $response = $this->get('/admin/partners');

        $response->assertStatus(403);
    }
}
