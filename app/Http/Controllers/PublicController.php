<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactEnquiryRequest;
use App\Models\BusinessSetting;
use App\Models\ClientReview;
use App\Models\ContactMessage;
use App\Models\GalleryItem;
use App\Models\Service;
use App\Models\WorkProcess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    /**
     * Public Homepage.
     */
    public function home(): View
    {
        $settings = BusinessSetting::getSettings();
        $services = Service::active()->get();
        $processes = WorkProcess::active()->get();
        $galleryItems = GalleryItem::active()->take(6)->get();
        $reviews = ClientReview::published()->take(4)->get();

        return view('public.home', compact('settings', 'services', 'processes', 'galleryItems', 'reviews'));
    }

    /**
     * About Us Page.
     */
    public function about(): View
    {
        $settings = BusinessSetting::getSettings();
        $services = Service::active()->get();

        return view('public.about', compact('settings', 'services'));
    }

    /**
     * Services Listing Page.
     */
    public function services(): View
    {
        $settings = BusinessSetting::getSettings();
        $services = Service::active()->get();

        return view('public.services.index', compact('settings', 'services'));
    }

    /**
     * Single Service Detail Page.
     */
    public function serviceDetail(Service $service): View
    {
        abort_unless($service->is_active, 404);

        $settings = BusinessSetting::getSettings();
        $otherServices = Service::active()->where('id', '!=', $service->id)->take(4)->get();

        return view('public.services.show', compact('settings', 'service', 'otherServices'));
    }

    /**
     * Work Process Page.
     */
    public function process(): View
    {
        $settings = BusinessSetting::getSettings();
        $processes = WorkProcess::active()->get();

        return view('public.process', compact('settings', 'processes'));
    }

    /**
     * Gallery Page.
     */
    public function gallery(Request $request): View
    {
        $settings = BusinessSetting::getSettings();
        $selectedCategory = $request->query('category', 'All');
        $query = GalleryItem::active();

        if (!empty($selectedCategory) && $selectedCategory !== 'All') {
            $query->where('category', $selectedCategory);
        }

        $galleryItems = $query->get();
        $categories = GalleryItem::CATEGORIES;

        return view('public.gallery', compact('settings', 'galleryItems', 'categories', 'selectedCategory'));
    }

    /**
     * Why Choose Us / Business Credibility Page.
     */
    public function whyUs(): View
    {
        $settings = BusinessSetting::getSettings();

        return view('public.why-us', compact('settings'));
    }

    /**
     * Client Reviews / Feedback Page.
     */
    public function reviews(): View
    {
        $settings = BusinessSetting::getSettings();
        $reviews = ClientReview::published()->get();

        return view('public.reviews', compact('settings', 'reviews'));
    }

    /**
     * Contact Us Page.
     */
    public function contact(): View
    {
        $settings = BusinessSetting::getSettings();
        $services = Service::active()->get();

        return view('public.contact', compact('settings', 'services'));
    }

    /**
     * Handle Public Contact / Merchant Enquiry Form Submission.
     */
    public function submitContact(ContactEnquiryRequest $request): RedirectResponse
    {
        ContactMessage::create($request->validated());

        return redirect()->route('contact')
            ->with('success', 'Thank you for reaching out to Riya Fashion. Your requirement has been received and our team will connect with you promptly.');
    }
}
