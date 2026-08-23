<?php

namespace Tests\Feature;

use App\Models\BusinessSetting;
use App\Models\User;
use Database\Seeders\BusinessSettingSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\WorkProcessSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BusinessSettingTest extends TestCase
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

    public function test_guest_cannot_view_business_settings_page(): void
    {
        $response = $this->get(route('admin.business.index'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_admin_can_view_business_settings_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.business.index'));

        $response->assertStatus(200);
        $response->assertSee('Riya Fashion');
        $response->assertSee('Pintu Kukadiya');
        $response->assertSee('Punagam');
        $response->assertSee('Surat, Gujarat');
        $response->assertSee('10+ Years');
    }

    public function test_admin_can_update_business_settings_successfully(): void
    {
        $response = $this->actingAs($this->admin)->put(route('admin.business.update'), [
            'business_name' => 'Riya Fashion',
            'tagline' => 'Premium Saree Work & Embellishment Specialists',
            'owner_name' => 'Pintu Kukadiya',
            'experience_years' => '10+ Years',
            'target_market' => 'Surat, Gujarat',
            'address_line' => 'B-115, Ishwernagar-2, Near Bombay Market to Sitanagar Road, Punagam',
            'city' => 'Surat',
            'state' => 'Gujarat',
            'pincode' => '395010',
            'country' => 'India',
            'phone' => '+91 9876543210',
            'whatsapp_number' => '919876543210',
            'email' => 'contact@riyafashion.com',
            'hours_mon_sat' => '9:00 AM - 8:30 PM',
            'hours_sun' => 'Closed',
            'holiday_notes' => 'Open on urgent processing request',
            'about_short' => '10+ years Surat saree processing workshop.',
            'about_full' => 'Comprehensive value-added saree craftsmanship in Punagam, Surat.',
            'bulk_work_heading' => 'Bulk & Time-Sensitive Work Support',
            'bulk_work_description' => 'Dedicated capacity for large saree volumes.',
            'process_note' => 'Requirement-based customized services.',
            'whatsapp_link' => 'https://wa.me/919876543210',
            'instagram_url' => 'https://instagram.com/riyafashion_surat',
        ]);

        $response->assertRedirect(route('admin.business.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('business_settings', [
            'tagline' => 'Premium Saree Work & Embellishment Specialists',
            'phone' => '+91 9876543210',
            'whatsapp_number' => '919876543210',
            'email' => 'contact@riyafashion.com',
            'instagram_url' => 'https://instagram.com/riyafashion_surat',
        ]);
    }

    public function test_validation_fails_on_invalid_email_and_invalid_url(): void
    {
        $response = $this->actingAs($this->admin)->put(route('admin.business.update'), [
            'business_name' => 'Riya Fashion',
            'owner_name' => 'Pintu Kukadiya',
            'experience_years' => '10+ Years',
            'target_market' => 'Surat, Gujarat',
            'address_line' => 'B-115, Ishwernagar-2, Punagam',
            'city' => 'Surat',
            'state' => 'Gujarat',
            'pincode' => '395010',
            'country' => 'India',
            'email' => 'not-an-email',
            'instagram_url' => 'not-a-valid-url',
        ]);

        $response->assertSessionHasErrors(['email', 'instagram_url']);
    }

    public function test_image_upload_and_removal_works_securely(): void
    {
        Storage::fake('public');

        $fakeLogo = UploadedFile::fake()->image('logo.png', 200, 200)->size(500); // 500KB

        $response = $this->actingAs($this->admin)->put(route('admin.business.update'), [
            'business_name' => 'Riya Fashion',
            'owner_name' => 'Pintu Kukadiya',
            'experience_years' => '10+ Years',
            'target_market' => 'Surat, Gujarat',
            'address_line' => 'B-115, Ishwernagar-2, Punagam',
            'city' => 'Surat',
            'state' => 'Gujarat',
            'pincode' => '395010',
            'country' => 'India',
            'logo' => $fakeLogo,
        ]);

        $response->assertRedirect(route('admin.business.index'));
        $settings = BusinessSetting::first();

        $this->assertNotNull($settings->logo_path);
        Storage::disk('public')->assertExists($settings->logo_path);

        // Now test removal
        $responseRemove = $this->actingAs($this->admin)->put(route('admin.business.update'), [
            'business_name' => 'Riya Fashion',
            'owner_name' => 'Pintu Kukadiya',
            'experience_years' => '10+ Years',
            'target_market' => 'Surat, Gujarat',
            'address_line' => 'B-115, Ishwernagar-2, Punagam',
            'city' => 'Surat',
            'state' => 'Gujarat',
            'pincode' => '395010',
            'country' => 'India',
            'remove_logo' => true,
        ]);

        $responseRemove->assertRedirect(route('admin.business.index'));
        $settings->refresh();
        $this->assertNull($settings->logo_path);
    }
}
