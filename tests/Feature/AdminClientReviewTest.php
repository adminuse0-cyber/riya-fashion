<?php

namespace Tests\Feature;

use App\Models\ClientReview;
use App\Models\User;
use Database\Seeders\BusinessSettingSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\WorkProcessSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminClientReviewTest extends TestCase
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

    public function test_guest_cannot_access_reviews_management(): void
    {
        $this->get(route('admin.reviews.index'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_reviews_management_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.reviews.index'));

        $response->assertStatus(200);
        $response->assertSee('Merchant Reviews & Testimonials', false);
        $response->assertSee('No Reviews Yet');
    }

    public function test_admin_can_create_a_review_with_rating(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.reviews.store'), [
            'client_name' => 'Kishore Bhai',
            'company_name' => 'Surat Saree Traders',
            'location' => 'Punagam, Surat',
            'review_text' => 'Consistently reliable lace patti border stitching and diamond work for our festive catalog sarees.',
            'rating' => 5,
            'is_published' => true,
            'display_order' => 1,
        ]);

        $response->assertRedirect(route('admin.reviews.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('client_reviews', [
            'client_name' => 'Kishore Bhai',
            'company_name' => 'Surat Saree Traders',
            'rating' => 5,
            'is_published' => true,
        ]);
    }

    public function test_admin_can_create_a_review_without_rating(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.reviews.store'), [
            'client_name' => 'Hitesh Patel',
            'location' => 'Surat, Gujarat',
            'review_text' => 'Timely hotfix stone application on bulk lot of 500 sarees with no damage.',
            'rating' => null,
            'is_published' => false,
            'display_order' => 2,
        ]);

        $response->assertRedirect(route('admin.reviews.index'));

        $this->assertDatabaseHas('client_reviews', [
            'client_name' => 'Hitesh Patel',
            'company_name' => null,
            'rating' => null,
            'is_published' => false,
        ]);
    }

    public function test_validation_rejects_invalid_rating(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.reviews.store'), [
            'client_name' => 'Merchant Test',
            'location' => 'Surat',
            'review_text' => 'Valid review text',
            'rating' => 6, // Invalid > 5
            'display_order' => 1,
        ]);

        $response->assertSessionHasErrors(['rating']);

        $responseZero = $this->actingAs($this->admin)->post(route('admin.reviews.store'), [
            'client_name' => 'Merchant Test',
            'location' => 'Surat',
            'review_text' => 'Valid review text',
            'rating' => 0, // Invalid < 1
            'display_order' => 1,
        ]);

        $responseZero->assertSessionHasErrors(['rating']);
    }

    public function test_validation_rejects_empty_review_text_and_client_name(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.reviews.store'), [
            'client_name' => '',
            'location' => '',
            'review_text' => '',
            'display_order' => 1,
        ]);

        $response->assertSessionHasErrors(['client_name', 'location', 'review_text']);
    }

    public function test_admin_can_edit_review(): void
    {
        $review = ClientReview::create([
            'client_name' => 'Original Name',
            'location' => 'Surat',
            'review_text' => 'Original text',
            'rating' => 4,
            'is_published' => false,
            'display_order' => 1,
        ]);

        $response = $this->actingAs($this->admin)->put(route('admin.reviews.update', $review), [
            'client_name' => 'Updated Merchant Name',
            'company_name' => 'Updated Firm',
            'location' => 'Punagam, Surat',
            'review_text' => 'Updated review testimonial text.',
            'rating' => 5,
            'is_published' => true,
            'display_order' => 2,
        ]);

        $response->assertRedirect(route('admin.reviews.index'));
        $this->assertDatabaseHas('client_reviews', [
            'id' => $review->id,
            'client_name' => 'Updated Merchant Name',
            'company_name' => 'Updated Firm',
            'rating' => 5,
            'is_published' => true,
            'display_order' => 2,
        ]);
    }

    public function test_admin_can_toggle_review_status(): void
    {
        $review = ClientReview::create([
            'client_name' => 'Toggle Test',
            'location' => 'Surat',
            'review_text' => 'Toggle text',
            'is_published' => false,
            'display_order' => 1,
        ]);

        $this->actingAs($this->admin)->patch(route('admin.reviews.toggle-status', $review));
        $review->refresh();
        $this->assertTrue($review->is_published);

        $this->actingAs($this->admin)->patch(route('admin.reviews.toggle-status', $review));
        $review->refresh();
        $this->assertFalse($review->is_published);
    }

    public function test_admin_can_delete_review(): void
    {
        $review = ClientReview::create([
            'client_name' => 'Delete Test',
            'location' => 'Surat',
            'review_text' => 'Delete text',
            'is_published' => true,
            'display_order' => 1,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('admin.reviews.destroy', $review));
        $response->assertRedirect(route('admin.reviews.index'));

        $this->assertDatabaseMissing('client_reviews', ['id' => $review->id]);
    }

    public function test_filter_reviews_by_published_and_draft(): void
    {
        ClientReview::create([
            'client_name' => 'Published Merchant',
            'location' => 'Surat',
            'review_text' => 'Published review text',
            'is_published' => true,
            'display_order' => 1,
        ]);

        ClientReview::create([
            'client_name' => 'Draft Merchant',
            'location' => 'Surat',
            'review_text' => 'Draft review text',
            'is_published' => false,
            'display_order' => 2,
        ]);

        $publishedResponse = $this->actingAs($this->admin)->get(route('admin.reviews.index', ['filter' => 'published']));
        $publishedResponse->assertSee('Published Merchant');
        $publishedResponse->assertDontSee('Draft Merchant');

        $draftResponse = $this->actingAs($this->admin)->get(route('admin.reviews.index', ['filter' => 'draft']));
        $draftResponse->assertSee('Draft Merchant');
        $draftResponse->assertDontSee('Published Merchant');
    }
}
