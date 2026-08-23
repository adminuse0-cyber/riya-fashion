<?php

namespace Tests\Feature;

use App\Models\GalleryItem;
use App\Models\User;
use Database\Seeders\BusinessSettingSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\WorkProcessSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminGalleryTest extends TestCase
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

    public function test_guest_cannot_access_gallery_management(): void
    {
        $this->get(route('admin.gallery.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_gallery_management_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.gallery.index'));
        $response->assertStatus(200);
        $response->assertSee('Upload Photograph');
    }

    public function test_admin_can_upload_gallery_photograph(): void
    {
        Storage::fake('public');
        $fakeImage = UploadedFile::fake()->image('diamond_work.jpg', 600, 400)->size(600);

        $response = $this->actingAs($this->admin)->post(route('admin.gallery.store'), [
            'title' => 'Diamond Work on Chiffon Saree',
            'category' => 'Diamond Work',
            'description' => 'Fine crystal diamond placement on sheer chiffon saree base.',
            'display_order' => 1,
            'is_active' => true,
            'image' => $fakeImage,
        ]);

        $response->assertRedirect(route('admin.gallery.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('gallery_items', [
            'title' => 'Diamond Work on Chiffon Saree',
            'category' => 'Diamond Work',
            'is_active' => true,
        ]);

        $item = GalleryItem::where('title', 'Diamond Work on Chiffon Saree')->first();
        $this->assertNotNull($item->image_path);
        Storage::disk('public')->assertExists($item->image_path);
    }

    public function test_gallery_upload_requires_title_category_and_image(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.gallery.store'), [
            'title' => '',
            'category' => '',
            'display_order' => 1,
        ]);

        $response->assertSessionHasErrors(['title', 'category', 'image']);
    }

    public function test_gallery_rejects_invalid_category(): void
    {
        Storage::fake('public');
        $fakeImage = UploadedFile::fake()->image('test.jpg', 300, 300)->size(200);

        $response = $this->actingAs($this->admin)->post(route('admin.gallery.store'), [
            'title' => 'Test Photo',
            'category' => 'Not A Valid Category',
            'display_order' => 1,
            'image' => $fakeImage,
        ]);

        $response->assertSessionHasErrors(['category']);
    }

    public function test_admin_can_update_gallery_item(): void
    {
        Storage::fake('public');
        $fakeImage = UploadedFile::fake()->image('original.jpg', 400, 400)->size(300);

        $item = GalleryItem::create([
            'title' => 'Original Title',
            'category' => 'Workshop',
            'image_path' => $fakeImage->store('gallery', 'public'),
            'display_order' => 1,
            'is_active' => true,
        ]);

        $newImage = UploadedFile::fake()->image('replacement.png', 400, 400)->size(300);

        $response = $this->actingAs($this->admin)->put(route('admin.gallery.update', $item), [
            'title' => 'Updated Workshop Photo',
            'category' => 'Workshop',
            'display_order' => 2,
            'is_active' => true,
            'image' => $newImage,
        ]);

        $response->assertRedirect(route('admin.gallery.index'));
        $this->assertDatabaseHas('gallery_items', [
            'id' => $item->id,
            'title' => 'Updated Workshop Photo',
            'display_order' => 2,
        ]);

        $item->refresh();
        Storage::disk('public')->assertExists($item->image_path);
    }

    public function test_admin_can_toggle_gallery_item_visibility(): void
    {
        Storage::fake('public');
        $fakeImage = UploadedFile::fake()->image('test.jpg', 300, 300)->size(200);

        $item = GalleryItem::create([
            'title' => 'Toggle Test Photo',
            'category' => 'Office',
            'image_path' => $fakeImage->store('gallery', 'public'),
            'display_order' => 1,
            'is_active' => true,
        ]);

        $this->actingAs($this->admin)->patch(route('admin.gallery.toggle-status', $item));
        $item->refresh();
        $this->assertFalse($item->is_active);

        $this->actingAs($this->admin)->patch(route('admin.gallery.toggle-status', $item));
        $item->refresh();
        $this->assertTrue($item->is_active);
    }

    public function test_admin_can_delete_gallery_item_and_image_is_removed(): void
    {
        Storage::fake('public');
        $fakeImage = UploadedFile::fake()->image('to_delete.jpg', 300, 300)->size(200);

        $item = GalleryItem::create([
            'title' => 'Delete Me Photo',
            'category' => 'Saree Work',
            'image_path' => $fakeImage->store('gallery', 'public'),
            'display_order' => 1,
            'is_active' => true,
        ]);

        Storage::disk('public')->assertExists($item->image_path);

        $response = $this->actingAs($this->admin)->delete(route('admin.gallery.destroy', $item));
        $response->assertRedirect(route('admin.gallery.index'));

        $this->assertDatabaseMissing('gallery_items', ['id' => $item->id]);
        Storage::disk('public')->assertMissing($item->image_path);
    }
}
