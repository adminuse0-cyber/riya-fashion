<?php

namespace Tests\Feature;

use App\Models\BusinessSetting;
use App\Models\ClientReview;
use App\Models\GalleryItem;
use App\Models\Service;
use App\Models\WorkProcess;
use Database\Seeders\BusinessSettingSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\WorkProcessSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicWebsiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            BusinessSettingSeeder::class,
            ServiceSeeder::class,
            WorkProcessSeeder::class,
        ]);
    }

    public function test_home_page_loads_successfully_with_cms_content(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Riya Fashion');
        $response->assertSee('Lace Patti / Border Work');
        $response->assertSee('Diamond Work');
        $response->assertSee('Hotfix / Stone Work');
        $response->assertSee('Roll Polish');
        $response->assertSee('Dhaga Cutting');
        $response->assertSee('Surat Textile Market');
        $response->assertSee('10+ Years');
    }

    public function test_about_page_loads_successfully(): void
    {
        $response = $this->get(route('about'));

        $response->assertStatus(200);
        $response->assertSee('About Riya Fashion');
        $response->assertSee('Pintu Kukadiya');
        $response->assertSee('Punagam');
        $response->assertSee('Surat');
    }

    public function test_services_page_loads_and_displays_only_active_services(): void
    {
        // Create an inactive service
        $inactive = Service::create([
            'title' => 'Hidden Secret Saree Work',
            'slug' => 'hidden-secret-saree-work',
            'short_description' => 'Should not appear publicly',
            'display_order' => 99,
            'is_active' => false,
        ]);

        $response = $this->get(route('services'));

        $response->assertStatus(200);
        $response->assertSee('Lace Patti / Border Work');
        $response->assertSee('Diamond Work');
        $response->assertDontSee('Hidden Secret Saree Work');
    }

    public function test_service_detail_page_loads_for_active_service(): void
    {
        $service = Service::where('slug', 'lace-patti-border-work')->first();

        $response = $this->get(route('services.show', $service));

        $response->assertStatus(200);
        $response->assertSee('Lace Patti / Border Work');
        $response->assertSee('Tailored for Your Saree Specifications');
    }

    public function test_service_detail_page_returns_404_for_inactive_service(): void
    {
        $inactive = Service::create([
            'title' => 'Inactive Service',
            'slug' => 'inactive-service',
            'short_description' => 'Inactive',
            'display_order' => 99,
            'is_active' => false,
        ]);

        $response = $this->get(route('services.show', $inactive));

        $response->assertStatus(404);
    }

    public function test_work_process_page_loads_successfully_with_disclaimer(): void
    {
        $response = $this->get(route('process'));

        $response->assertStatus(200);
        $response->assertSee('Our Saree Processing Workflow');
        $response->assertSee('Requirement-Based Process Customization');
        $response->assertSee('Saree / Material Received');
    }

    public function test_gallery_page_loads_and_displays_only_active_items(): void
    {
        GalleryItem::create([
            'title' => 'Active Diamond Saree Photo',
            'category' => 'Diamond Work',
            'image_path' => 'gallery/active.jpg',
            'display_order' => 1,
            'is_active' => true,
        ]);

        GalleryItem::create([
            'title' => 'Hidden Unapproved Photo',
            'category' => 'Diamond Work',
            'image_path' => 'gallery/hidden.jpg',
            'display_order' => 2,
            'is_active' => false,
        ]);

        $response = $this->get(route('gallery'));

        $response->assertStatus(200);
        $response->assertSee('Active Diamond Saree Photo');
        $response->assertDontSee('Hidden Unapproved Photo');
    }

    public function test_why_choose_us_page_loads_successfully(): void
    {
        $response = $this->get(route('why-us'));

        $response->assertStatus(200);
        $response->assertSee('Why Partner with Riya Fashion');
        $response->assertSee('10+ Years Saree Experience');
        $response->assertSee('Surat-Based Own Facility');
    }

    public function test_reviews_page_displays_only_published_reviews(): void
    {
        ClientReview::create([
            'client_name' => 'Published Merchant Ramesh',
            'location' => 'Surat',
            'review_text' => 'Authentic published feedback from Surat trader.',
            'rating' => 5,
            'is_published' => true,
            'display_order' => 1,
        ]);

        ClientReview::create([
            'client_name' => 'Draft Merchant Suresh',
            'location' => 'Surat',
            'review_text' => 'Draft unapproved feedback.',
            'is_published' => false,
            'display_order' => 2,
        ]);

        $response = $this->get(route('reviews'));

        $response->assertStatus(200);
        $response->assertSee('Published Merchant Ramesh');
        $response->assertDontSee('Draft Merchant Suresh');
    }

    public function test_reviews_page_shows_truthful_empty_state_when_zero_published(): void
    {
        // 0 published reviews
        $response = $this->get(route('reviews'));

        $response->assertStatus(200);
        $response->assertSee('Merchant feedback will be added here as genuine reviews become available.');
    }

    public function test_contact_page_loads_successfully(): void
    {
        $response = $this->get(route('contact'));

        $response->assertStatus(200);
        $response->assertSee('Send Your Requirement');
        $response->assertSee('Punagam');
    }

    public function test_contact_form_validates_required_fields(): void
    {
        $response = $this->post(route('contact.submit'), [
            'merchant_name' => '',
            'phone' => '',
            'message' => '',
        ]);

        $response->assertSessionHasErrors(['merchant_name', 'phone', 'message']);
    }

    public function test_contact_form_stores_enquiry_in_database_and_redirects(): void
    {
        $response = $this->post(route('contact.submit'), [
            'merchant_name' => 'Ketan Bhai',
            'company_name' => 'Ketan Sarees Surat',
            'phone' => '+91 9898989898',
            'email' => 'ketan@example.com',
            'service_interested' => 'Lace Patti / Border Work',
            'estimated_quantity' => '500+ Sarees (Bulk)',
            'message' => 'We need 500 chiffon sarees with 2-inch lace patti stitched before Diwali season.',
        ]);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'merchant_name' => 'Ketan Bhai',
            'company_name' => 'Ketan Sarees Surat',
            'phone' => '+91 9898989898',
            'service_interested' => 'Lace Patti / Border Work',
            'is_read' => false,
            'status' => 'New',
        ]);
    }

    public function test_unauthenticated_visitor_cannot_access_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    }
}
