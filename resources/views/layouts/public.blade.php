<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', ($settings->business_name ?? 'Riya Fashion') . ' | Saree Work & Textile Processing in Surat')</title>
    <meta name="description" content="@yield('meta_description', 'Riya Fashion is a premier B2B saree processing and value-addition workshop in Surat, Gujarat with 10+ years experience. Specializing in Lace Patti, Diamond Work, Hotfix Stone Work, Roll Polish, and Dhaga Cutting for textile merchants.')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ $settings->business_name ?? 'Riya Fashion' }}">
    <meta property="og:title" content="@yield('og_title', View::yieldContent('title'))">
    <meta property="og:description" content="@yield('og_description', View::yieldContent('meta_description'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:locale" content="en_IN">
    @php
        $ogImage = !empty($settings->workshop_cover_path) 
            ? asset('storage/' . $settings->workshop_cover_path) 
            : (!empty($settings->logo_path) ? asset('storage/' . $settings->logo_path) : '');
    @endphp
    @if(!empty($ogImage))
        <meta property="og:image" content="@yield('og_image', $ogImage)">
    @endif

    <!-- Twitter / X Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', View::yieldContent('title'))">
    <meta name="twitter:description" content="@yield('twitter_description', View::yieldContent('meta_description'))">
    @if(!empty($ogImage))
        <meta name="twitter:image" content="@yield('twitter_image', $ogImage)">
    @endif

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Global JSON-LD Schema (LocalBusiness & WebSite / Textile Processor) -->
    @php
        $sameAs = [];
        if (!empty($settings->instagram_url)) $sameAs[] = $settings->instagram_url;
        if (!empty($settings->facebook_url)) $sameAs[] = $settings->facebook_url;
        if (!empty($settings->google_maps_url)) $sameAs[] = $settings->google_maps_url;

        $schemaData = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'LocalBusiness',
                    '@id' => url('/') . '/#business',
                    'name' => $settings->business_name ?? 'Riya Fashion',
                    'description' => $settings->tagline ?? 'Professional Saree Work & Textile Processing in Surat',
                    'url' => url('/'),
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => $settings->address_line ?? 'B-115, Ishwernagar-2, Near Bombay Market to Sitanagar Road, Punagam',
                        'addressLocality' => $settings->city ?? 'Surat',
                        'addressRegion' => $settings->state ?? 'Gujarat',
                        'postalCode' => $settings->pincode ?? '395010',
                        'addressCountry' => 'IN',
                    ],
                    'founder' => [
                        '@type' => 'Person',
                        'name' => $settings->owner_name ?? 'Pintu Kukadiya',
                    ],
                    'areaServed' => [
                        '@type' => 'City',
                        'name' => 'Surat',
                    ],
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => url('/') . '/#website',
                    'url' => url('/'),
                    'name' => $settings->business_name ?? 'Riya Fashion',
                    'publisher' => [
                        '@id' => url('/') . '/#business',
                    ],
                ]
            ]
        ];

        if (!empty($settings->phone)) {
            $schemaData['@graph'][0]['telephone'] = $settings->phone;
        }
        if (!empty($settings->email)) {
            $schemaData['@graph'][0]['email'] = $settings->email;
        }
        if (!empty($ogImage)) {
            $schemaData['@graph'][0]['image'] = $ogImage;
        }
        if (!empty($settings->hours_mon_sat)) {
            $schemaData['@graph'][0]['openingHours'] = 'Mo-Sa ' . $settings->hours_mon_sat;
        }
        if (!empty($sameAs)) {
            $schemaData['@graph'][0]['sameAs'] = $sameAs;
        }
    @endphp
    <script type="application/ld+json">
    {!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
    </script>

    <!-- Page-Specific Structured Data -->
    @yield('schema_json')

    <style>
        :root {
            --rf-navy: #0b1329;
            --rf-navy-dark: #060b17;
            --rf-navy-light: #152243;
            --rf-navy-card: #0f1c3f;
            --rf-gold: #c59b27;
            --rf-gold-light: #dfb743;
            --rf-gold-subtle: rgba(197, 155, 39, 0.12);
            --rf-gold-border: rgba(197, 155, 39, 0.28);
            --rf-gold-glow: rgba(197, 155, 39, 0.4);
            --rf-cream: #faf8f5;
            --rf-cream-dark: #f1ede4;
            --rf-slate: #475569;
            --rf-charcoal: #1e293b;
            --rf-border: rgba(226, 232, 240, 0.85);
            --rf-radius-sm: 8px;
            --rf-radius: 14px;
            --rf-radius-lg: 20px;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #fbfaf8;
            color: #1e293b;
            line-height: 1.65;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Accessibility: Skip to Content */
        .skip-link {
            position: absolute;
            top: -50px;
            left: 20px;
            background: var(--rf-gold);
            color: #ffffff;
            padding: 8px 16px;
            z-index: 9999;
            border-radius: var(--rf-radius-sm);
            font-weight: 600;
            transition: top 0.2s ease;
            text-decoration: none;
        }
        .skip-link:focus {
            top: 15px;
        }

        .font-cinzel {
            font-family: 'Cinzel', Georgia, serif;
            letter-spacing: 0.5px;
        }

        /* Top Announcement Bar */
        .top-bar {
            background-color: var(--rf-navy-dark);
            color: #cbd5e1;
            font-size: 12px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .top-bar a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .top-bar a:hover, .top-bar a:focus-visible {
            color: var(--rf-gold-light);
            outline: none;
        }

        /* Main Navbar */
        .main-navbar {
            background: rgba(11, 19, 41, 0.98);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--rf-gold-border);
            padding-top: 10px;
            padding-bottom: 10px;
            transition: all 0.3s ease;
            z-index: 1030;
        }

        .navbar-brand .brand-logo-text {
            font-family: 'Cinzel', serif;
            font-size: 21px;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: #ffffff;
            margin: 0;
            line-height: 1.15;
        }

        .navbar-brand .brand-sub-text {
            font-size: 10px;
            letter-spacing: 0.8px;
            color: var(--rf-gold-light);
            text-transform: uppercase;
            font-weight: 600;
        }

        .nav-link {
            color: #e2e8f0 !important;
            font-weight: 500;
            font-size: 13.5px;
            padding: 8px 13px !important;
            border-radius: var(--rf-radius-sm);
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link:hover, .nav-link:focus-visible {
            color: var(--rf-gold-light) !important;
            background: rgba(197, 155, 39, 0.12);
            outline: none;
        }

        .nav-link.active {
            color: var(--rf-gold-light) !important;
            background: rgba(197, 155, 39, 0.18);
            font-weight: 600;
        }

        /* Gold Gradient Buttons */
        .btn-gold {
            background: linear-gradient(135deg, #c59b27 0%, #b38918 100%);
            border: 1px solid #c59b27;
            color: #ffffff !important;
            font-weight: 600;
            border-radius: var(--rf-radius-sm);
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(197, 155, 39, 0.25);
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-gold:hover, .btn-gold:focus-visible {
            background: linear-gradient(135deg, #dfb743 0%, #c59b27 100%);
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(197, 155, 39, 0.4);
            outline: none;
        }

        .btn-outline-gold {
            border: 1.5px solid var(--rf-gold);
            color: var(--rf-gold) !important;
            background: transparent;
            font-weight: 600;
            border-radius: var(--rf-radius-sm);
            transition: all 0.25s ease;
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-outline-gold:hover, .btn-outline-gold:focus-visible {
            background: var(--rf-gold);
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(197, 155, 39, 0.25);
            outline: none;
        }

        .btn-whatsapp {
            background-color: #25d366;
            color: #ffffff !important;
            border: none;
            font-weight: 600;
            border-radius: var(--rf-radius-sm);
            transition: all 0.2s ease;
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-whatsapp:hover, .btn-whatsapp:focus-visible {
            background-color: #1ebd5a;
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(37, 211, 102, 0.35);
            outline: none;
        }

        /* Section Badges */
        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--rf-gold-subtle);
            border: 1px solid var(--rf-gold-border);
            color: #9a7309;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 50px;
            margin-bottom: 12px;
        }

        .section-tag-dark {
            background: rgba(197, 155, 39, 0.16);
            border: 1px solid rgba(197, 155, 39, 0.45);
            color: var(--rf-gold-light);
        }

        .section-title {
            font-family: 'Cinzel', serif;
            font-weight: 700;
            color: var(--rf-navy);
            letter-spacing: 0.5px;
            line-height: 1.3;
        }

        /* Premium Textile Cards */
        .premium-card {
            background: #ffffff;
            border: 1px solid var(--rf-border);
            border-radius: var(--rf-radius);
            transition: transform 0.28s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.28s cubic-bezier(0.4, 0, 0.2, 1), border-color 0.28s ease;
            box-shadow: 0 2px 8px rgba(11, 19, 41, 0.04);
            position: relative;
        }

        .premium-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 36px -10px rgba(11, 19, 41, 0.12);
            border-color: var(--rf-gold-border);
        }

        .service-icon-box {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            background: var(--rf-gold-subtle);
            color: var(--rf-gold);
            border: 1px solid var(--rf-gold-border);
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .premium-card:hover .service-icon-box {
            background: var(--rf-gold);
            color: #ffffff;
            transform: rotate(-4deg) scale(1.06);
            box-shadow: 0 6px 18px rgba(197, 155, 39, 0.35);
        }

        /* Hero Banner */
        .hero-banner {
            background: radial-gradient(circle at 10% 20%, #172554 0%, #0b1329 80%, #060b17 100%);
            color: #ffffff;
            position: relative;
            overflow: hidden;
            padding: 70px 0 80px;
        }

        .hero-banner::before {
            content: "";
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            background-image: radial-gradient(rgba(197, 155, 39, 0.08) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }

        /* Footer */
        .public-footer {
            background: var(--rf-navy-dark);
            color: #94a3b8;
            font-size: 13.5px;
            border-top: 3px solid var(--rf-gold);
        }

        .public-footer h6 {
            color: #ffffff;
            font-family: 'Cinzel', serif;
            letter-spacing: 0.5px;
            font-weight: 700;
        }

        .public-footer a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .public-footer a:hover, .public-footer a:focus-visible {
            color: var(--rf-gold-light);
            outline: none;
        }

        /* Focus Outlines for Accessibility */
        a:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible, select:focus-visible {
            outline: 2px solid var(--rf-gold);
            outline-offset: 2px;
        }

        /* Form Inputs Polish */
        .form-control, .form-select {
            border-radius: var(--rf-radius-sm);
            border: 1px solid #cbd5e1;
            padding: 10px 14px;
            font-size: 14px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--rf-gold);
            box-shadow: 0 0 0 3px rgba(197, 155, 39, 0.2);
            outline: none;
        }

        /* Back to Top Button */
        #btnBackToTop {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--rf-navy);
            color: var(--rf-gold);
            border: 1px solid var(--rf-gold-border);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        #btnBackToTop:hover {
            background: var(--rf-gold);
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(197, 155, 39, 0.4);
        }

        /* Responsive Breakpoints */
        @media (max-width: 991.98px) {
            .hero-banner {
                padding: 45px 0 55px;
            }
            .navbar-collapse {
                background: var(--rf-navy);
                border: 1px solid var(--rf-gold-border);
                border-radius: var(--rf-radius);
                padding: 16px;
                margin-top: 12px;
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
            }
            .nav-link {
                padding: 10px 14px !important;
            }
        }

        @media (max-width: 575.98px) {
            .top-bar {
                text-align: center;
                font-size: 11px;
                padding: 6px 0;
            }
            .navbar-brand .brand-logo-text {
                font-size: 18px;
            }
            .navbar-brand .brand-sub-text {
                font-size: 9px;
            }
            .section-title {
                font-size: 1.5rem !important;
            }
            .display-5 {
                font-size: 1.85rem !important;
            }
            .display-6 {
                font-size: 1.65rem !important;
            }
            .btn-gold, .btn-whatsapp, .btn-outline-gold {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <!-- Skip Link for Accessibility -->
    <a href="#mainContent" class="skip-link">Skip to main content</a>

    <!-- 1. Top Announcement Bar -->
    <div class="top-bar">
        <div class="container d-flex flex-column flex-sm-row align-items-center justify-content-between gap-1 gap-sm-2">
            <div class="d-flex align-items-center gap-2 gap-sm-3 flex-wrap justify-content-center">
                <span><i class="bi bi-geo-alt-fill text-warning me-1" aria-hidden="true"></i> Surat Textile Market, Gujarat</span>
                <span class="d-none d-md-inline text-muted">•</span>
                <span class="d-none d-md-inline"><i class="bi bi-award-fill text-warning me-1" aria-hidden="true"></i> 10+ Years Experience</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                @if(!empty($settings->phone))
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->phone) }}" title="Call Riya Fashion">
                        <i class="bi bi-telephone-fill text-warning me-1" aria-hidden="true"></i> {{ $settings->phone }}
                    </a>
                @endif
                <span class="text-muted" aria-hidden="true">|</span>
                <a href="{{ route('admin.login') }}" class="text-warning-emphasis" title="Owner Administration Portal">
                    <i class="bi bi-shield-lock me-1" aria-hidden="true"></i> Admin Portal
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark main-navbar sticky-top" aria-label="Main Navigation">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ route('home') }}">
                <div class="service-icon-box" style="width: 42px; height: 42px; font-size: 20px; border-radius: 10px;">
                    <i class="bi bi-gem" aria-hidden="true"></i>
                </div>
                <div>
                    <span class="brand-logo-text d-block">{{ $settings->business_name ?? 'RIYA FASHION' }}</span>
                    <span class="brand-sub-text d-block">B2B Saree Processing & Embellishments</span>
                </div>
            </a>

            <button class="navbar-toggler border-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 py-2 py-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services*') ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('process') ? 'active' : '' }}" href="{{ route('process') }}">Work Process</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('why-us') ? 'active' : '' }}" href="{{ route('why-us') }}">Why Choose Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reviews') ? 'active' : '' }}" href="{{ route('reviews') }}">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact Us</a>
                    </li>
                </ul>

                <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2 mt-3 mt-lg-0">
                    @php
                        $waNumber = preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '919876543210');
                        $waLink = $settings->whatsapp_link ?: 'https://wa.me/' . $waNumber;
                    @endphp
                    <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp btn-sm px-3 py-2" title="Chat directly with Riya Fashion on WhatsApp">
                        <i class="bi bi-whatsapp fs-6" aria-hidden="true"></i>
                        <span>WhatsApp</span>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-gold btn-sm px-3 py-2" title="Submit your saree requirements">
                        Merchant Enquiry
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Global Alert Notifications -->
    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill fs-5 text-success" aria-hidden="true"></i>
                <div class="small fw-semibold">{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show rounded-4 border-0 shadow-sm d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5 text-warning" aria-hidden="true"></i>
                <div class="small fw-semibold">{{ session('warning') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- 3. Dynamic Page Content -->
    <main id="mainContent">
        @yield('content')
    </main>

    <!-- 4. Universal B2B Call to Action Banner -->
    <section class="py-5" style="background: radial-gradient(circle at 10% 20%, #1e293b 0%, #0b1329 100%); color: #ffffff; border-top: 1px solid rgba(197, 155, 39, 0.2);" aria-label="Partnership Call to Action">
        <div class="container py-3 text-center">
            <span class="section-tag section-tag-dark mb-3">Surat Textile Merchant Partnership</span>
            <h2 class="section-title text-white fs-2 mb-3">Looking for Dependable Saree Processing & Embellishment Capacity?</h2>
            <p class="text-light opacity-75 mx-auto mb-4" style="max-width: 680px; font-size: 15px;">
                With 10+ years of dedicated experience in Surat, Riya Fashion provides reliable border stitching, diamond placement, hotfix stones, roll polishing, and dhaga cutting for your saree catalog lots.
            </p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3" style="max-width: 500px; margin: 0 auto;">
                <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp px-4 py-2">
                    <i class="bi bi-whatsapp fs-5 me-1" aria-hidden="true"></i> Chat on WhatsApp
                </a>
                <a href="{{ route('contact') }}" class="btn btn-gold px-4 py-2">
                    <i class="bi bi-send-fill me-1" aria-hidden="true"></i> Submit Requirement Enquiry
                </a>
            </div>
        </div>
    </section>

    <!-- 5. Public Footer -->
    <footer class="public-footer pt-5 pb-4" aria-label="Site Footer">
        <div class="container">
            <div class="row g-4 pb-4 border-bottom border-secondary border-opacity-25">
                <!-- Col 1: Business Identity -->
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="service-icon-box" style="width: 38px; height: 38px; font-size: 18px; border-radius: 8px;">
                            <i class="bi bi-gem" aria-hidden="true"></i>
                        </div>
                        <h5 class="fw-bold text-white mb-0 font-cinzel">{{ $settings->business_name ?? 'RIYA FASHION' }}</h5>
                    </div>
                    <p class="small text-light opacity-75 mb-3" style="line-height: 1.6;">
                        {{ $settings->tagline ?? 'Professional Saree Work & Textile Processing' }}. Specialized B2B value-addition workshop catering to textile merchants and saree traders in Surat, Gujarat.
                    </p>
                    <div class="badge bg-secondary bg-opacity-25 text-warning border border-secondary border-opacity-50 p-2 small">
                        <i class="bi bi-shield-check me-1" aria-hidden="true"></i> 10+ Years Experience • Own Workshop & Office
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="mb-3 text-warning">Quick Links</h6>
                    <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
                        <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right text-warning small me-1" aria-hidden="true"></i> Home</a></li>
                        <li><a href="{{ route('about') }}"><i class="bi bi-chevron-right text-warning small me-1" aria-hidden="true"></i> About Us</a></li>
                        <li><a href="{{ route('services') }}"><i class="bi bi-chevron-right text-warning small me-1" aria-hidden="true"></i> Saree Services</a></li>
                        <li><a href="{{ route('process') }}"><i class="bi bi-chevron-right text-warning small me-1" aria-hidden="true"></i> Work Process</a></li>
                        <li><a href="{{ route('gallery') }}"><i class="bi bi-chevron-right text-warning small me-1" aria-hidden="true"></i> Photo Gallery</a></li>
                        <li><a href="{{ route('why-us') }}"><i class="bi bi-chevron-right text-warning small me-1" aria-hidden="true"></i> Why Choose Us</a></li>
                        <li><a href="{{ route('reviews') }}"><i class="bi bi-chevron-right text-warning small me-1" aria-hidden="true"></i> Merchant Reviews</a></li>
                        <li><a href="{{ route('contact') }}"><i class="bi bi-chevron-right text-warning small me-1" aria-hidden="true"></i> Contact Us</a></li>
                    </ul>
                </div>

                <!-- Col 3: Saree Services -->
                <div class="col-lg-3 col-md-6 col-6">
                    <h6 class="mb-3 text-warning">Saree Services</h6>
                    <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
                        <li><a href="{{ route('services') }}"><i class="bi bi-scissors text-warning small me-1" aria-hidden="true"></i> Lace Patti / Border Work</a></li>
                        <li><a href="{{ route('services') }}"><i class="bi bi-gem text-warning small me-1" aria-hidden="true"></i> Diamond Work</a></li>
                        <li><a href="{{ route('services') }}"><i class="bi bi-stars text-warning small me-1" aria-hidden="true"></i> Hotfix / Stone Work</a></li>
                        <li><a href="{{ route('services') }}"><i class="bi bi-arrow-repeat text-warning small me-1" aria-hidden="true"></i> Roll Polish</a></li>
                        <li><a href="{{ route('services') }}"><i class="bi bi-check2-circle text-warning small me-1" aria-hidden="true"></i> Dhaga Cutting</a></li>
                    </ul>
                </div>

                <!-- Col 4: Workshop Location -->
                <div class="col-lg-3 col-md-6">
                    <h6 class="mb-3 text-warning">Workshop & Office</h6>
                    <ul class="list-unstyled small mb-0 d-flex flex-column gap-2">
                        <li class="d-flex align-items-start gap-2">
                            <i class="bi bi-geo-alt-fill text-warning mt-1" aria-hidden="true"></i>
                            <span>{{ $settings->address_line ?? 'B-115, Ishwernagar-2, Near Bombay Market to Sitanagar Road, Punagam' }}, {{ $settings->city ?? 'Surat' }}, {{ $settings->state ?? 'Gujarat' }} - {{ $settings->pincode ?? '395010' }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-person-fill text-warning"></i>
                            <span>Proprietor: <strong>{{ $settings->owner_name ?? 'Pintu Kukadiya' }}</strong></span>
                        </li>
                        @if(!empty($settings->hours_mon_sat))
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-clock-fill text-warning"></i>
                            <span>Mon - Sat: {{ $settings->hours_mon_sat }}</span>
                        </li>
                        @endif
                        @if(!empty($settings->email))
                        <li class="d-flex align-items-center gap-2">
                            <i class="bi bi-envelope-fill text-warning"></i>
                            <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2 pt-3 small text-muted">
                <div>
                    &copy; {{ date('Y') }} <strong>{{ $settings->business_name ?? 'Riya Fashion' }}</strong>. All rights reserved. Surat, Gujarat.
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-secondary">B2B Textile Saree Work Portal</span>
                    <a href="{{ route('admin.login') }}" class="text-secondary hover-gold"><i class="bi bi-lock-fill" aria-hidden="true"></i> Admin</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button type="button" id="btnBackToTop" aria-label="Back to top">
        <i class="bi bi-arrow-up" aria-hidden="true"></i>
    </button>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Back to Top Vanilla JS -->
    <script>
        const backToTopBtn = document.getElementById('btnBackToTop');
        if (backToTopBtn) {
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopBtn.style.display = 'flex';
                } else {
                    backToTopBtn.style.display = 'none';
                }
            });
            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    </script>
</body>
</html>