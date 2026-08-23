<?php

namespace Tests\Feature;

use App\Models\BusinessSetting;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\User;
use Database\Seeders\BusinessSettingSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\WorkProcessSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            BusinessSettingSeeder::class,
            ServiceSeeder::class,
            WorkProcessSeeder::class,
        ]);

        $this->admin = User::create([
            'name' => 'Pintu Kukadiya',
            'email' => 'admin@riyafashion.com',
            'password' => Hash::make('SecretPass123!'),
            'is_admin' => true,
        ]);
    }

    public function test_guest_cannot_view_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_admin_can_view_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Welcome back, Pintu Kukadiya');
        $response->assertSee('RIYA FASHION');
        $response->assertSee('Active Services');
        $response->assertSee('Business Profile Snapshot');
        $response->assertSee('Surat, Gujarat');
        $response->assertSee('No Enquiries Received Yet');
    }

    public function test_dashboard_displays_real_contact_message_when_present(): void
    {
        ContactMessage::create([
            'merchant_name' => 'Rajeshbhai Patel',
            'company_name' => 'Shree Saree Traders',
            'phone' => '9876543210',
            'email' => 'rajesh@example.com',
            'service_interested' => 'Hotfix / Stone Work',
            'estimated_quantity' => '500+ Sarees',
            'message' => 'Need hotfix work on 500 designer georgette sarees.',
            'is_read' => false,
            'status' => 'New',
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Rajeshbhai Patel');
        $response->assertSee('Shree Saree Traders');
        $response->assertSee('9876543210');
        $response->assertSee('Hotfix / Stone Work');
        $response->assertDontSee('No Enquiries Received Yet');
    }
}
