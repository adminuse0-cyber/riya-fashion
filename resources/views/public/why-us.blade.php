@extends('layouts.public')

@section('title', 'Why Choose Us — ' . ($settings->business_name ?? 'Riya Fashion') . ' | B2B Saree Processing in Surat')
@section('meta_description', 'Discover why Surat textile merchants trust Riya Fashion: 10+ years experience, own workshop in Punagam, requirement-based processing, and bulk work capability.')

@section('content')

<!-- Header Banner -->
<section class="py-5" style="background: radial-gradient(circle at 10% 20%, #172554 0%, #0b1329 100%); color: #ffffff;">
    <div class="container py-2 py-md-3">
        <span class="section-tag section-tag-dark mb-2">Merchant Trust & Credibility</span>
        <h1 class="display-6 fw-bold text-white font-cinzel mb-2">Why Partner with {{ $settings->business_name ?? 'Riya Fashion' }}</h1>
        <p class="text-light opacity-75 mb-0" style="max-width: 650px;">
            A proven track record of reliable saree value-addition, craftsmanship accuracy, and dependable turnaround in Surat, Gujarat.
        </p>
    </div>
</section>

<!-- Core Credibility Pillars -->
<section class="py-5 bg-white">
    <div class="container py-3 py-md-4">
        <div class="text-center mx-auto mb-5" style="max-width: 680px;">
            <span class="section-tag"><i class="bi bi-award-fill" aria-hidden="true"></i> Established Business Pillars</span>
            <h2 class="section-title fs-2 mb-3">Our Core Business Strengths</h2>
            <p class="text-muted">
                Built on verified operational facts, experienced artisans, and genuine textile market understanding.
            </p>
        </div>

        <div class="row g-4">
            <!-- Pillar 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 premium-card p-4">
                    <div class="service-icon-box mb-3">
                        <i class="bi bi-clock-history" aria-hidden="true"></i>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-2 font-cinzel">10+ Years Saree Experience</h3>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        Over a decade of continuous operational experience in the Surat textile market, understanding fabrics, embellishments, and merchant delivery schedules.
                    </p>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 premium-card p-4">
                    <div class="service-icon-box mb-3">
                        <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-2 font-cinzel">Surat-Based Own Facility</h3>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        Operating from our own dedicated office and workshop in Punagam, Surat (Near Bombay Market to Sitanagar Road), providing convenient local accessibility for merchants.
                    </p>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 premium-card p-4">
                    <div class="service-icon-box mb-3">
                        <i class="bi bi-sliders" aria-hidden="true"></i>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-2 font-cinzel">Requirement-Based Customization</h3>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        {{ $settings->process_note ?? 'Services are customized according to each saree design and merchant requirements. Not every saree requires every service.' }}
                    </p>
                </div>
            </div>

            <!-- Pillar 4 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 premium-card p-4">
                    <div class="service-icon-box mb-3">
                        <i class="bi bi-boxes" aria-hidden="true"></i>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-2 font-cinzel">Bulk Lot Readiness</h3>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        {{ $settings->bulk_work_description ?? 'Equipped with dedicated workshop capacity and experienced craftsmen to handle large volume saree orders and time-sensitive requirements with consistent quality.' }}
                    </p>
                </div>
            </div>

            <!-- Pillar 5 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 premium-card p-4">
                    <div class="service-icon-box mb-3">
                        <i class="bi bi-lightning-charge-fill" aria-hidden="true"></i>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-2 font-cinzel">Time-Sensitive Rush Support</h3>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        Dependable handling during festival seasons, catalog launches, and urgent dispatch deadlines with transparent communication on completion timelines.
                    </p>
                </div>
            </div>

            <!-- Pillar 6 -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 premium-card p-4">
                    <div class="service-icon-box mb-3">
                        <i class="bi bi-check2-circle" aria-hidden="true"></i>
                    </div>
                    <h3 class="h5 fw-bold text-dark mb-2 font-cinzel">Direct Owner Supervision</h3>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        Supervised directly by proprietor <strong>{{ $settings->owner_name ?? 'Pintu Kukadiya' }}</strong>, ensuring personalized attention and accountability on every saree order.
                    </p>
                </div>
            </div>
        </div>

        <!-- Partnership Banner -->
        <div class="mt-5 p-4 rounded-4 bg-light border text-center">
            <h3 class="h4 fw-bold text-dark mb-2 font-cinzel">Connect with Our Surat Workshop</h3>
            <p class="text-muted small mx-auto mb-4" style="max-width: 600px;">
                Whether you have regular monthly wholesale lots or urgent festive catalog orders, discuss your requirements directly with our team.
            </p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3" style="max-width: 440px; margin: 0 auto;">
                <a href="{{ route('contact') }}" class="btn btn-gold px-4 py-2">
                    <i class="bi bi-send-fill me-1" aria-hidden="true"></i> Send Requirement
                </a>
                @php
                    $waNumber = preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '919876543210');
                    $waLink = $settings->whatsapp_link ?: 'https://wa.me/' . $waNumber;
                @endphp
                <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp px-4 py-2">
                    <i class="bi bi-whatsapp me-1" aria-hidden="true"></i> Direct WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
