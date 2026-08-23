<?php

namespace App\Http\Controllers;

use App\Models\BusinessSetting;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate dynamic XML sitemap for search engines.
     */
    public function sitemap(): Response
    {
        $staticRoutes = [
            route('home') => ['priority' => '1.0', 'changefreq' => 'weekly'],
            route('about') => ['priority' => '0.8', 'changefreq' => 'monthly'],
            route('services') => ['priority' => '0.9', 'changefreq' => 'weekly'],
            route('process') => ['priority' => '0.8', 'changefreq' => 'monthly'],
            route('gallery') => ['priority' => '0.8', 'changefreq' => 'weekly'],
            route('why-us') => ['priority' => '0.8', 'changefreq' => 'monthly'],
            route('reviews') => ['priority' => '0.7', 'changefreq' => 'weekly'],
            route('contact') => ['priority' => '0.9', 'changefreq' => 'monthly'],
        ];

        // Fetch only active services for dynamic URLs
        $activeServices = Service::active()->get();

        $content = view('sitemap', compact('staticRoutes', 'activeServices'))->render();

        return response($content, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Serve robots.txt dynamically with the correct Sitemap URL.
     */
    public function robots(): Response
    {
        $sitemapUrl = route('sitemap');
        
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin\n";
        $content .= "Disallow: /admin/*\n\n";
        $content .= "Sitemap: {$sitemapUrl}\n";

        return response($content, 200)
            ->header('Content-Type', 'text/plain; charset=utf-8');
    }
}
