<?php

namespace Tests\Feature;

use App\Models\BusinessSetting;
use App\Models\GalleryItem;
use App\Models\Service;
use Database\Seeders\BusinessSettingSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\WorkProcessSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoAndSitemapTest extends TestCase
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

    /** 1. Public pages contain SEO title */
    public function test_1_public_pages_contain_seo_title(): void
    {
        $pages = ['home', 'about', 'services', 'process', 'gallery', 'why-us', 'reviews', 'contact'];

        foreach ($pages as $page) {
            $response = $this->get(route($page));
            $response->assertStatus(200);
            $response->assertSee('<title>', false);
            $response->assertSee('Riya Fashion');
        }
    }

    /** 2. Public pages contain meta description */
    public function test_2_public_pages_contain_meta_description(): void
    {
        $pages = ['home', 'about', 'services', 'process', 'gallery', 'why-us', 'reviews', 'contact'];

        foreach ($pages as $page) {
            $response = $this->get(route($page));
            $response->assertStatus(200);
            $response->assertSee('<meta name="description"', false);
        }
    }

    /** 3. Canonical URL exists on all public pages */
    public function test_3_canonical_url_exists_on_public_pages(): void
    {
        $pages = ['home', 'about', 'services', 'process', 'gallery', 'why-us', 'reviews', 'contact'];

        foreach ($pages as $page) {
            $response = $this->get(route($page));
            $response->assertStatus(200);
            $response->assertSee('<link rel="canonical" href="' . route($page) . '">', false);
        }
    }

    /** 4. Sitemap returns 200 */
    public function test_4_sitemap_returns_200_valid_xml(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml; charset=utf-8');
        $response->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false);
        $response->assertSee('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', false);
    }

    /** 5. Sitemap contains public URLs */
    public function test_5_sitemap_contains_public_urls(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertSee(route('home'));
        $response->assertSee(route('about'));
        $response->assertSee(route('services'));
        $response->assertSee(route('process'));
        $response->assertSee(route('gallery'));
        $response->assertSee(route('why-us'));
        $response->assertSee(route('reviews'));
        $response->assertSee(route('contact'));
        $response->assertSee(route('services.show', 'lace-patti-border-work'));
        $response->assertSee(route('services.show', 'diamond-work'));
    }

    /** 6. Sitemap excludes admin URLs */
    public function test_6_sitemap_excludes_admin_urls(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertDontSee('/admin');
        $response->assertDontSee('/admin/dashboard');
        $response->assertDontSee('/admin/login');
        $response->assertDontSee('/admin/services');
    }

    /** 7. Sitemap excludes inactive services */
    public function test_7_sitemap_excludes_inactive_services(): void
    {
        Service::create([
            'title' => 'Secret Inactive Saree Work',
            'slug' => 'secret-inactive-saree-work',
            'short_description' => 'Hidden from crawlers',
            'display_order' => 99,
            'is_active' => false,
        ]);

        $response = $this->get('/sitemap.xml');
        $response->assertDontSee('secret-inactive-saree-work');
    }

    /** 8. Robots.txt returns 200 */
    public function test_8_robots_txt_returns_200(): void
    {
        $response = $this->get('/robots.txt');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/plain; charset=utf-8');
        $response->assertSee('User-agent: *');
        $response->assertSee('Allow: /');
    }

    /** 9. Robots.txt contains sitemap URL */
    public function test_9_robots_txt_contains_sitemap_url(): void
    {
        $response = $this->get('/robots.txt');

        $response->assertSee('Sitemap: ' . url('/sitemap.xml'));
    }

    /** 10. Robots.txt blocks admin */
    public function test_10_robots_txt_blocks_admin(): void
    {
        $response = $this->get('/robots.txt');

        $response->assertSee('Disallow: /admin');
        $response->assertSee('Disallow: /admin/*');
    }

    /** 11. LocalBusiness JSON-LD exists */
    public function test_11_local_business_json_ld_exists(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('application/ld+json', false);
        $response->assertSee('"@type": "LocalBusiness"', false);
        $response->assertSee('Riya Fashion');
        $response->assertSee('Pintu Kukadiya');
        $response->assertSee('Surat');
        $response->assertSee('Gujarat');
        $response->assertSee('395010');
    }

    /** 12. Service JSON-LD exists on service detail pages */
    public function test_12_service_json_ld_exists_on_service_detail_pages(): void
    {
        $service = Service::where('slug', 'diamond-work')->first();

        $response = $this->get(route('services.show', $service));

        $response->assertStatus(200);
        $response->assertSee('application/ld+json', false);
        $response->assertSee('"@type": "Service"', false);
        $response->assertSee('Diamond Work');
    }

    /** 13. Breadcrumb JSON-LD exists */
    public function test_13_breadcrumb_json_ld_exists(): void
    {
        $service = Service::where('slug', 'diamond-work')->first();

        $response = $this->get(route('services.show', $service));

        $response->assertStatus(200);
        $response->assertSee('"@type": "BreadcrumbList"', false);
        $response->assertSee(route('home'));
        $response->assertSee(route('services'));
        $response->assertSee(route('services.show', $service));
    }

    /** 14. Public images have alt attributes where applicable */
    public function test_14_public_images_have_alt_attributes_where_applicable(): void
    {
        GalleryItem::create([
            'title' => 'Lace Patti Border Stitching Lot',
            'category' => 'Lace Patti Work',
            'image_path' => 'gallery/sample.jpg',
            'is_active' => true,
        ]);

        $response = $this->get(route('gallery'));
        $response->assertStatus(200);
        $response->assertSee('alt="Lace Patti Border Stitching Lot"', false);
        $response->assertSee('loading="lazy"', false);
    }

    /** 15. Admin routes remain protected */
    public function test_15_admin_routes_remain_protected(): void
    {
        $protectedAdminRoutes = [
            '/admin/dashboard',
            '/admin/business',
            '/admin/services',
            '/admin/gallery',
            '/admin/reviews',
        ];

        foreach ($protectedAdminRoutes as $route) {
            $response = $this->get($route);
            $response->assertRedirect(route('admin.login'));
        }
    }
}
