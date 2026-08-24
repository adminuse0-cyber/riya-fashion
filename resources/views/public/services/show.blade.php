@extends('layouts.public')

@section('title', $service->title . ' in Surat | ' . ($settings->business_name ?? 'Riya Fashion'))
@section('meta_description', $service->short_description . ' Professional saree work and processing by Riya Fashion in Surat, Gujarat.')

@section('schema_json')
<!-- Service & Breadcrumb JSON-LD Structured Data -->
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => $service->title,
    'description' => $service->short_description,
    'provider' => [
        '@type' => 'LocalBusiness',
        'name' => $settings->business_name ?? 'Riya Fashion',
        'url' => url('/'),
    ],
    'areaServed' => [
        '@type' => 'City',
        'name' => 'Surat',
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
</script>
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => route('home'),
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Services',
            'item' => route('services'),
        ],
        [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => $service->title,
            'item' => route('services.show', $service),
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection

@section('content')

<!-- Header Banner -->
<section class="py-5" style="background: radial-gradient(circle at 10% 20%, #172554 0%, #0b1329 100%); color: #ffffff;">
    <div class="container py-2 py-md-3">
        <nav aria-label="breadcrumb" class="mb-2">
            <ol class="breadcrumb small text-light opacity-75 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-light">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services') }}" class="text-light">Services</a></li>
                <li class="breadcrumb-item active text-warning" aria-current="page">{{ $service->title }}</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-3 mt-3">
            <div class="service-icon-box">
                <i class="bi {{ $service->icon ?? 'bi-gem' }}" aria-hidden="true"></i>
            </div>
            <div>
                <h1 class="display-6 fw-bold text-white font-cinzel mb-0">{{ $service->title }}</h1>
                <div class="text-warning small mt-1">Value-Added Saree Processing • Surat Workshop</div>
            </div>
        </div>
    </div>
</section>

<!-- Service Details Section -->
<section class="py-5 bg-white">
    <div class="container py-3 py-md-4">
        <div class="row g-4 g-lg-5">
            <!-- Main Content Column -->
            <div class="col-lg-8">
                @if($service->image_path)
                    <div class="mb-4 rounded-4 overflow-hidden shadow-sm border" style="max-height: 420px; background: #f8fafc;">
                        <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="w-100 h-100 object-fit-cover" loading="lazy">
                    </div>
                @endif

                <h2 class="h3 fw-bold text-dark mb-3 font-cinzel">Overview & Craftsmanship</h2>
                <p class="lead text-dark opacity-90 mb-4" style="font-size: 17px; line-height: 1.8;">
                    {{ $service->short_description }}
                </p>

                @if($service->full_description)
                    <div class="text-muted mb-4" style="line-height: 1.8; white-space: pre-line;">
                        {{ $service->full_description }}
                    </div>
                @endif

                <!-- Requirement Disclaimer -->
                <div class="p-4 bg-light rounded-4 border border-warning-subtle mb-4">
                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-info-circle-fill text-warning fs-4 mt-1" aria-hidden="true"></i>
                        <div>
                            <h3 class="h6 fw-bold text-dark mb-1">Tailored for Your Saree Specifications</h3>
                            <p class="small text-muted mb-0">
                                This service is customized according to fabric weight, design layout, and your merchant buyer’s exact requirements. You can combine this with our other processing steps (e.g. Lace Patti + Roll Polish + Dhaga Cutting) or request it as a standalone service.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Callout Box -->
                <div class="p-4 rounded-4" style="background: #faf8f5; border: 1px solid #ebd9b0;">
                    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                        <div>
                            <h3 class="h5 fw-bold text-dark mb-1 font-cinzel">Have a Bulk Saree Lot for {{ $service->title }}?</h3>
                            <p class="small text-muted mb-0">Bring your saree samples or raw materials directly to our Punagam workshop for review.</p>
                        </div>
                        <a href="{{ $settings->getWhatsAppUrl('Hello Riya Fashion, I would like to enquire about ' . $service->title . ' for saree lots.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp px-3 py-2 flex-shrink-0">
                            <i class="bi bi-whatsapp me-1" aria-hidden="true"></i> WhatsApp Inquiry
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-lg-4">
                <!-- Sticky Wrapper on Desktop -->
                <div class="position-sticky" style="top: 100px;">
                    <!-- Enquiry Card -->
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-light border">
                        <h3 class="h5 fw-bold text-dark mb-3 font-cinzel border-bottom pb-2">Submit Enquiry</h3>
                        <p class="small text-muted mb-3">Discuss delivery timelines, sample testing, and bulk capacity for {{ $service->title }}.</p>
                        
                        <a href="{{ route('contact') }}?service={{ urlencode($service->title) }}" class="btn btn-gold w-100 py-2 mb-2 fw-bold">
                            <i class="bi bi-send-fill me-1" aria-hidden="true"></i> Send Merchant Enquiry
                        </a>
                        
                        <a href="{{ $settings->getWhatsAppUrl('Hello Riya Fashion, I would like to enquire about ' . $service->title . ' for saree lots.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp w-100 py-2 fw-bold">
                            <i class="bi bi-whatsapp me-1" aria-hidden="true"></i> Instant WhatsApp Chat
                        </a>
                    </div>

                    <!-- Other Services -->
                    @if($otherServices->count() > 0)
                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border">
                            <h3 class="h6 fw-bold text-dark mb-3 font-cinzel border-bottom pb-2">Other Saree Services</h3>
                            <ul class="list-unstyled mb-0 d-flex flex-column gap-3">
                                @foreach($otherServices as $other)
                                    <li>
                                        <a href="{{ route('services.show', $other) }}" class="text-decoration-none d-flex align-items-center justify-content-between text-dark hover-gold">
                                            <span class="small fw-semibold"><i class="bi {{ $other->icon ?? 'bi-gem' }} text-warning me-2" aria-hidden="true"></i> {{ $other->title }}</span>
                                            <i class="bi bi-chevron-right small text-muted" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
