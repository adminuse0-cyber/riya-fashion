<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\ClientReview;
use App\Models\ContactMessage;
use App\Models\GalleryItem;
use App\Models\Service;
use App\Models\WorkProcess;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the main admin dashboard with real database-driven KPIs,
     * business profile snapshot, recent enquiries, review status, and gallery preview.
     */
    public function index(): View
    {
        $servicesCount = Service::where('is_active', true)->count();
        $totalServicesCount = Service::count();
        $galleryCount = GalleryItem::count();
        $reviewsCount = ClientReview::where('is_published', true)->count();
        $totalReviewsCount = ClientReview::count();
        $unreadMessagesCount = ContactMessage::unread()->count();
        $totalMessagesCount = ContactMessage::count();
        $processStepsCount = WorkProcess::count();

        $settings = BusinessSetting::getSettings();
        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentReviews = ClientReview::latest()->take(3)->get();
        $recentGallery = GalleryItem::latest()->take(4)->get();
        $servicesList = Service::orderBy('display_order')->take(5)->get();

        return view('admin.dashboard', compact(
            'servicesCount',
            'totalServicesCount',
            'galleryCount',
            'reviewsCount',
            'totalReviewsCount',
            'unreadMessagesCount',
            'totalMessagesCount',
            'processStepsCount',
            'settings',
            'recentMessages',
            'recentReviews',
            'recentGallery',
            'servicesList'
        ));
    }
}
