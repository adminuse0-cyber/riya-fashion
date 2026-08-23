<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BusinessSettingController;
use App\Http\Controllers\Admin\ClientReviewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Website Routes (Phase 9 & 10)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/services/{service:slug}', [PublicController::class, 'serviceDetail'])->name('services.show');
Route::get('/process', [PublicController::class, 'process'])->name('process');
Route::get('/gallery', [PublicController::class, 'gallery'])->name('gallery');
Route::get('/why-us', [PublicController::class, 'whyUs'])->name('why-us');
Route::get('/reviews', [PublicController::class, 'reviews'])->name('reviews');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->name('contact.submit');

/*
|--------------------------------------------------------------------------
| SEO & Crawlability Routes (Phase 11)
|--------------------------------------------------------------------------
*/
Route::get('/sitemap.xml', [SitemapController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
});

/*
|--------------------------------------------------------------------------
| Protected Admin Routes (Requires Admin Authentication)
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Phase 5: Business Information CMS Routes
    Route::get('/business', [BusinessSettingController::class, 'index'])->name('business.index');
    Route::put('/business', [BusinessSettingController::class, 'update'])->name('business.update');

    // Phase 6: Services Management CRUD Routes
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::patch('/services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');

    // Phase 7: Gallery Management CRUD Routes
    Route::resource('gallery', GalleryController::class, ['parameters' => ['gallery' => 'gallery']])->except(['show']);
    Route::patch('/gallery/{gallery}/toggle-status', [GalleryController::class, 'toggleStatus'])->name('gallery.toggle-status');

    // Phase 8: Client Reviews Management Routes
    Route::resource('reviews', ClientReviewController::class)->except(['show']);
    Route::patch('/reviews/{review}/toggle-status', [ClientReviewController::class, 'toggleStatus'])->name('reviews.toggle-status');

    // Navigation Placeholders for Upcoming Phases
    Route::get('/processes', function () {
        return redirect()->route('admin.dashboard')->with('warning', 'Work Process module will be configured in a future phase.');
    })->name('processes.index');

    Route::get('/messages', function () {
        return redirect()->route('admin.dashboard')->with('warning', 'Contact Messages module is active on the Dashboard.');
    })->name('messages.index');
});
