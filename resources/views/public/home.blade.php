@extends('layouts.public')

@section('title', ($settings->business_name ?? 'Riya Fashion') . ' — ' . ($settings->tagline ?? 'Professional Saree Work & Textile Processing | Surat'))

@section('content')

<!-- 1. HERO SECTION -->
<section class="hero-banner" aria-label="Hero Introduction">
    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-7">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 border border-warning border-opacity-25 text-warning small fw-semibold mb-3">
                    <i class="bi bi-geo-alt-fill text-warning" aria-hidden="true"></i> Surat Textile Market • Punagam, Gujarat
                </div>

                <h1 class="display-5 fw-bold text-white mb-3 font-cinzel">
                    {{ $settings->hero_heading ?? 'Professional Saree Work & Value-Added Textile Processing' }}
                </h1>

                <p class="lead text-light opacity-90 mb-4" style="font-size: 16px; line-height: 1.7; max-width: 620px;">
                    {{ $settings->hero_subheading ?? 'Specialized value-addition, border stitching, diamond placement, hotfix stones, roll polishing, and thread cutting for Surat textile merchants.' }}
                </p>

                <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-3 mb-4 pb-2">
                    <a href="{{ $settings->hero_cta_link ?? route('services') }}" class="btn btn-gold px-4 py-3 fw-bold">
                        <i class="bi bi-grid-fill me-1" aria-hidden="true"></i> {{ $settings->hero_cta_text ?? 'Explore Saree Services' }}
                    </a>

                    @php
                        $waNumber = preg_replace('/[^0-9]/', '', $settings->whatsapp_number ?? '919876543210');
                        $waLink = $settings->whatsapp_link ?: 'https://wa.me/' . $waNumber;
                    @endphp
                    <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp px-4 py-3 fw-bold">
                        <i class="bi bi-whatsapp fs-5" aria-hidden="true"></i> Connect on WhatsApp
                    </a>
                </div>

                <!-- Credibility Badges -->
                <div class="d-flex flex-wrap align-items-center gap-3 gap-md-4 pt-3 border-top border-white border-opacity-10 text-light small">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-warning fs-5" aria-hidden="true"></i>
                        <span><strong>10+ Years</strong> in Surat</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-warning fs-5" aria-hidden="true"></i>
                        <span><strong>Bulk & Rush</strong> Support</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-warning fs-5" aria-hidden="true"></i>
                        <span><strong>Requirement-Based</strong> Tailoring</span>
                    </div>
                </div>
            </div>

            <!-- Hero Visual / Business Snapshot -->
            <div class="col-lg-5">
                <div class="card border-0 rounded-4 overflow-hidden shadow-lg p-4 p-sm-4" style="background: rgba(15, 28, 63, 0.7); backdrop-filter: blur(14px); border: 1px solid rgba(197, 155, 39, 0.35) !important;">
                    <div class="d-flex align-items-center justify-content-between border-bottom border-white border-opacity-10 pb-3 mb-3">
                        <div>
                            <span class="badge bg-warning text-dark fw-bold px-2 py-1 small">B2B Processing Partner</span>
                            <h2 class="h5 fw-bold text-white font-cinzel mb-0 mt-1">{{ $settings->business_name ?? 'Riya Fashion' }}</h2>
                        </div>
                        <div class="service-icon-box" style="width: 46px; height: 46px; font-size: 20px;">
                            <i class="bi bi-gem" aria-hidden="true"></i>
                        </div>
                    </div>

                    <p class="small text-light opacity-75 mb-3" style="line-height: 1.6;">
                        {{ $settings->about_short ?? 'Dedicated saree processing workshop in Punagam, Surat, offering tailored embellishments and finishing for textile traders and wholesalers.' }}
                    </p>

                    <!-- Service Checklist -->
                    <div class="d-flex flex-column gap-2 mb-3">
                        <div class="p-2 px-3 rounded-3 bg-white bg-opacity-5 border border-white border-opacity-10 d-flex align-items-center justify-content-between text-light small">
                            <span><i class="bi bi-scissors text-warning me-2" aria-hidden="true"></i> Lace Patti / Border Work</span>
                            <span class="badge bg-white bg-opacity-10 text-warning">Specialized</span>
                        </div>
                        <div class="p-2 px-3 rounded-3 bg-white bg-opacity-5 border border-white border-opacity-10 d-flex align-items-center justify-content-between text-light small">
                            <span><i class="bi bi-gem text-warning me-2" aria-hidden="true"></i> Diamond Work</span>
                            <span class="badge bg-white bg-opacity-10 text-warning">Precision</span>
                        </div>
                        <div class="p-2 px-3 rounded-3 bg-white bg-opacity-5 border border-white border-opacity-10 d-flex align-items-center justify-content-between text-light small">
                            <span><i class="bi bi-stars text-warning me-2" aria-hidden="true"></i> Hotfix / Stone Work</span>
                            <span class="badge bg-white bg-opacity-10 text-warning">Heat-Press</span>
                        </div>
                        <div class="p-2 px-3 rounded-3 bg-white bg-opacity-5 border border-white border-opacity-10 d-flex align-items-center justify-content-between text-light small">
                            <span><i class="bi bi-arrow-repeat text-warning me-2" aria-hidden="true"></i> Roll Polish & Dhaga Cutting</span>
                            <span class="badge bg-white bg-opacity-10 text-warning">Finishing</span>
                        </div>
                    </div>

                    <div class="p-2 bg-dark bg-opacity-50 rounded-3 text-center small text-light opacity-75 border border-white border-opacity-10">
                        <i class="bi bi-pin-map-fill text-warning me-1" aria-hidden="true"></i> Workshop: Punagam, Surat, Gujarat
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. SERVICES OVERVIEW SECTION -->
<section class="py-5 bg-white" id="services" aria-label="Services Overview">
    <div class="container py-3 py-md-4">
        <div class="text-center mx-auto mb-5" style="max-width: 680px;">
            <span class="section-tag"><i class="bi bi-scissors" aria-hidden="true"></i> Value-Addition Capabilities</span>
            <h2 class="section-title fs-2 mb-3">Saree Processing & Embellishment Services</h2>
            <p class="text-muted">
                Crafted to enhance your saree collections with dependable quality, meticulous placement, and timely delivery.
            </p>
        </div>

        <div class="row g-4">
            @forelse($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 premium-card p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="service-icon-box">
                                    <i class="bi {{ $service->icon ?? 'bi-gem' }}" aria-hidden="true"></i>
                                </div>
                                <span class="badge bg-light text-secondary border px-2 py-1 small">#{{ $service->display_order }}</span>
                            </div>

                            <h3 class="h5 fw-bold text-dark mb-2 font-cinzel">{{ $service->title }}</h3>
                            <p class="text-muted small mb-3" style="line-height: 1.6;">
                                {{ $service->short_description }}
                            </p>
                        </div>

                        <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                            <a href="{{ route('services.show', $service) }}" class="text-primary fw-semibold small text-decoration-none d-inline-flex align-items-center gap-1">
                                View Details <i class="bi bi-arrow-right" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('contact') }}?service={{ urlencode($service->title) }}" class="btn btn-outline-gold btn-sm py-1 px-3" style="font-size: 11.5px; min-height: 32px;">
                                Enquire
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-4 text-muted">
                    Saree services are currently being updated.
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('services') }}" class="btn btn-outline-secondary px-4 py-2 small fw-semibold">
                View All Saree Processing Services <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<!-- 3. REQUIREMENT-BASED PROCESS DISCLAIMER BANNER -->
<section class="py-4" style="background: #faf5ea; border-top: 1px solid #ebd9b0; border-bottom: 1px solid #ebd9b0;" aria-label="Process Customization Disclaimer">
    <div class="container">
        <div class="row align-items-center g-3">
            <div class="col-md-2 text-center text-md-start">
                <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-25 text-warning-emphasis rounded-circle p-3 fs-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-sliders" aria-hidden="true"></i>
                </div>
            </div>
            <div class="col-md-7 text-center text-md-start">
                <h3 class="h5 fw-bold text-dark mb-1">Tailored, Requirement-Based Saree Processing</h3>
                <p class="text-muted small mb-0">
                    {{ $settings->process_note ?? 'Services are customized according to each saree design and merchant requirements. Not every saree requires every service.' }}
                </p>
            </div>
            <div class="col-md-3 text-center text-md-end">
                <a href="{{ route('process') }}" class="btn btn-gold btn-sm px-3 py-2">
                    Learn Work Process <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 4. BULK WORK & TIME-SENSITIVE SUPPORT -->
<section class="py-5" style="background-color: #f8fafc;" aria-label="Production Capacity">
    <div class="container py-3 py-md-4">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-6">
                <span class="section-tag"><i class="bi bi-buildings" aria-hidden="true"></i> Production Capacity</span>
                <h2 class="section-title fs-2 mb-3">{{ $settings->bulk_work_heading ?? 'Bulk & Time-Sensitive Work Support' }}</h2>
                <p class="text-muted mb-4" style="line-height: 1.7;">
                    {{ $settings->bulk_work_description ?? 'Equipped with dedicated workshop capacity and experienced craftsmen to handle large volume saree orders and time-sensitive requirements with consistent quality.' }}
                </p>

                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="p-3 bg-white rounded-3 border shadow-sm h-100">
                            <div class="fw-bold text-dark mb-1"><i class="bi bi-boxes text-warning me-1" aria-hidden="true"></i> Bulk Order Handling</div>
                            <div class="small text-muted">Dedicated infrastructure for handling regular bulk saree lots for wholesale merchants.</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-white rounded-3 border shadow-sm h-100">
                            <div class="fw-bold text-dark mb-1"><i class="bi bi-lightning-charge-fill text-warning me-1" aria-hidden="true"></i> Urgent Rush Lots</div>
                            <div class="small text-muted">Reliable support during major wedding and festive season catalog rush deliveries.</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-3">
                    <a href="{{ route('why-us') }}" class="btn btn-gold px-4 py-2">
                        Why Choose Riya Fashion
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-secondary px-4 py-2">
                        Discuss Bulk Lot
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 rounded-4 shadow-sm p-4 bg-white border">
                    <h3 class="h5 fw-bold text-dark mb-3 border-bottom pb-2 font-cinzel">Surat Workshop & Office Snapshot</h3>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-3 small">
                        <li class="d-flex align-items-start gap-3">
                            <div class="p-2 bg-primary-subtle text-primary rounded-3 flex-shrink-0"><i class="bi bi-geo-alt-fill" aria-hidden="true"></i></div>
                            <div>
                                <strong class="text-dark">Workshop Location:</strong>
                                <div class="text-muted">{{ $settings->address_line ?? 'B-115, Ishwernagar-2, Near Bombay Market to Sitanagar Road, Punagam' }}, {{ $settings->city ?? 'Surat' }}, {{ $settings->state ?? 'Gujarat' }}</div>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3">
                            <div class="p-2 bg-success-subtle text-success rounded-3 flex-shrink-0"><i class="bi bi-award-fill" aria-hidden="true"></i></div>
                            <div>
                                <strong class="text-dark">Market Experience:</strong>
                                <div class="text-muted">10+ Years serving saree traders, manufacturers, and merchants in Surat.</div>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3">
                            <div class="p-2 bg-warning-subtle text-warning-emphasis rounded-3 flex-shrink-0"><i class="bi bi-person-badge-fill" aria-hidden="true"></i></div>
                            <div>
                                <strong class="text-dark">Proprietor:</strong>
                                <div class="text-muted">{{ $settings->owner_name ?? 'Pintu Kukadiya' }}</div>
                            </div>
                        </li>
                        <li class="d-flex align-items-start gap-3">
                            <div class="p-2 bg-info-subtle text-info-emphasis rounded-3 flex-shrink-0"><i class="bi bi-clock-fill" aria-hidden="true"></i></div>
                            <div>
                                <strong class="text-dark">Operating Hours:</strong>
                                <div class="text-muted">{{ $settings->business_hours ?? 'Monday - Saturday: 9:00 AM - 8:00 PM' }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. WORK PROCESS OVERVIEW SECTION -->
<section class="py-5 bg-white" aria-label="Process Steps Overview">
    <div class="container py-3 py-md-4">
        <div class="text-center mx-auto mb-5" style="max-width: 680px;">
            <span class="section-tag"><i class="bi bi-arrow-repeat" aria-hidden="true"></i> Systematic Workflow</span>
            <h2 class="section-title fs-2 mb-3">Our 6-Step Requirement-Based Process</h2>
            <p class="text-muted">
                Each saree lot is handled with systematic care, from receiving fabrics to final delivery.
            </p>
        </div>

        <div class="row g-4">
            @forelse($processes as $process)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 bg-light p-4 rounded-4 position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge bg-gold text-white fw-bold px-3 py-1 rounded-pill" style="background: #c59b27;">
                                Step {{ $process->step_number }}
                            </span>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2 font-cinzel">{{ $process->title }}</h3>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">
                            {{ $process->description }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">Process steps configured in database.</div>
            @endforelse
        </div>

        <div class="text-center mt-4 pt-2">
            <a href="{{ route('process') }}" class="btn btn-outline-secondary btn-sm px-4">
                Detailed Work Process Explanation <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</section>

<!-- 6. GALLERY PREVIEW (If Photos Available) -->
@if($galleryItems->count() > 0)
<section class="py-5" style="background-color: #f8fafc;" aria-label="Gallery Preview">
    <div class="container py-3 py-md-4">
        <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between mb-4">
            <div>
                <span class="section-tag"><i class="bi bi-images" aria-hidden="true"></i> Visual Proof of Work</span>
                <h2 class="section-title fs-2 mb-1">Craftsmanship & Workshop Gallery</h2>
                <p class="text-muted small mb-0">Genuine photographs of completed saree work and our Surat workshop.</p>
            </div>
            <a href="{{ route('gallery') }}" class="btn btn-outline-secondary btn-sm mt-3 mt-md-0">
                View Full Gallery <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
        </div>

        <div class="row g-3">
            @foreach($galleryItems as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border shadow-sm rounded-4 overflow-hidden">
                        <div style="height: 220px; background: #e2e8f0; overflow: hidden;">
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover" loading="lazy">
                        </div>
                        <div class="card-body p-3">
                            <span class="badge bg-primary-subtle text-primary small mb-1">{{ $item->category }}</span>
                            <h3 class="h6 fw-bold text-dark mb-0">{{ $item->title }}</h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- 7. MERCHANT REVIEWS (Or Truthful Empty State) -->
<section class="py-5 bg-white" aria-label="Merchant Reviews">
    <div class="container py-3 py-md-4">
        <div class="text-center mx-auto mb-4" style="max-width: 680px;">
            <span class="section-tag"><i class="bi bi-chat-quote" aria-hidden="true"></i> Merchant Testimonials</span>
            <h2 class="section-title fs-2 mb-3">Merchant Feedback & Reviews</h2>
        </div>

        @if($reviews->count() > 0)
            <div class="row g-4">
                @foreach($reviews as $review)
                    <div class="col-lg-6">
                        <div class="card h-100 premium-card p-4">
                            @if($review->rating)
                                <div class="d-flex gap-1 text-warning mb-2" aria-label="{{ $review->rating }} out of 5 stars">
                                    @for($i = 1; $i <= $review->rating; $i++)
                                        <i class="bi bi-star-fill" aria-hidden="true"></i>
                                    @endfor
                                </div>
                            @endif
                            <p class="text-secondary small fst-italic mb-3" style="line-height: 1.6;">
                                "{{ $review->review_text }}"
                            </p>
                            <div class="d-flex align-items-center gap-2 pt-2 border-top">
                                <div class="p-2 bg-light rounded-circle text-primary"><i class="bi bi-person-fill" aria-hidden="true"></i></div>
                                <div>
                                    <div class="fw-bold text-dark small">{{ $review->client_name }}</div>
                                    <div class="text-muted" style="font-size: 11px;">
                                        {{ $review->company_name ? $review->company_name . ' • ' : '' }}{{ $review->location }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center p-4 bg-light rounded-4 border mx-auto" style="max-width: 600px;">
                <i class="bi bi-chat-quote text-muted fs-3 mb-2 d-block" aria-hidden="true"></i>
                <h3 class="h6 fw-bold text-dark mb-1">Merchant Feedback</h3>
                <p class="text-muted small mb-0">
                    Merchant feedback will be added here as genuine reviews become available. Riya Fashion maintains strict authenticity with zero fabricated testimonials.
                </p>
            </div>
        @endif
    </div>
</section>

@endsection
