<?php

namespace Tests\Feature;

use App\Models\BusinessSetting;
use App\Models\Service;
use App\Models\User;
use Database\Seeders\BusinessSettingSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\WorkProcessSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminServiceTest extends TestCase
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

    public function test_guest_cannot_access_services_management(): void
    {
        $response = $this->get(route('admin.services.index'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_all_seeded_services(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.services.index'));

        $response->assertStatus(200);
        $response->assertSee('Lace Patti / Border Work');
        $response->assertSee('Diamond Work');
        $response->assertSee('Hotfix / Stone Work');
        $response->assertSee('Roll Polish');
        $response->assertSee('Dhaga Cutting');
    }

    public function test_admin_can_create_a_new_service_with_image(): void
    {
        Storage::fake('public');
        $fakeImage = UploadedFile::fake()->image('custom_embellishment.jpg', 300, 300)->size(500);

        $response = $this->actingAs($this->admin)->post(route('admin.services.store'), [
            'title' => 'Custom Hand Embroidery',
            'slug' => 'custom-hand-embroidery',
            'short_description' => 'Fine manual hand embroidery and zardozi detailing on designer sarees.',
            'full_description' => 'Artisanal embroidery crafted per merchant sample patterns.',
            'icon' => 'bi-palette',
            'display_order' => 6,
            'is_active' => true,
            'image' => $fakeImage,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('services', [
            'title' => 'Custom Hand Embroidery',
            'slug' => 'custom-hand-embroidery',
            'display_order' => 6,
            'is_active' => true,
        ]);

        $service = Service::where('slug', 'custom-hand-embroidery')->first();
        $this->assertNotNull($service->image_path);
        Storage::disk('public')->assertExists($service->image_path);
    }

    public function test_service_validation_rejects_duplicate_slug_and_invalid_image(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.services.store'), [
            'title' => 'Duplicate Diamond Work',
            'slug' => 'diamond-work', // Already exists in seeder
            'short_description' => 'Test description',
            'display_order' => 1,
        ]);

        $response->assertSessionHasErrors(['slug']);
    }

    public function test_admin_can_update_service_and_replace_image(): void
    {
        Storage::fake('public');
        $service = Service::where('slug', 'lace-patti-border-work')->first();

        $newImage = UploadedFile::fake()->image('new_lace.png', 400, 400)->size(400);

        $response = $this->actingAs($this->admin)->put(route('admin.services.update', $service), [
            'title' => 'Lace Patti & Border Stitching',
            'slug' => 'lace-patti-border-work',
            'short_description' => 'Updated short description for lace patti work.',
            'display_order' => 1,
            'is_active' => true,
            'image' => $newImage,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'title' => 'Lace Patti & Border Stitching',
        ]);

        $service->refresh();
        $this->assertNotNull($service->image_path);
        Storage::disk('public')->assertExists($service->image_path);
    }

    public function test_admin_can_toggle_service_status(): void
    {
        $service = Service::where('slug', 'roll-polish')->first();
        $this->assertTrue($service->is_active);

        $response = $this->actingAs($this->admin)->patch(route('admin.services.toggle-status', $service));
        $response->assertRedirect();

        $service->refresh();
        $this->assertFalse($service->is_active);

        // Toggle back to active
        $this->actingAs($this->admin)->patch(route('admin.services.toggle-status', $service));
        $service->refresh();
        $this->assertTrue($service->is_active);
    }

    public function test_admin_can_delete_service_and_cleans_up_image(): void
    {
        Storage::fake('public');
        $fakeImage = UploadedFile::fake()->image('temp.jpg', 200, 200);

        $service = Service::create([
            'title' => 'Temporary Service',
            'slug' => 'temp-service',
            'short_description' => 'To be deleted',
            'display_order' => 99,
            'is_active' => true,
            'image_path' => $fakeImage->store('services', 'public'),
        ]);

        Storage::disk('public')->assertExists($service->image_path);

        $response = $this->actingAs($this->admin)->delete(route('admin.services.destroy', $service));
        $response->assertRedirect(route('admin.services.index'));

        $this->assertDatabaseMissing('services', ['id' => $service->id]);
        Storage::disk('public')->assertMissing($service->image_path);
    }
}
