@extends('layouts.public')

@section('title', 'Saree Processing & Embellishment Services — ' . ($settings->business_name ?? 'Riya Fashion'))
@section('meta_description', 'Explore Riya Fashion\'s value-added saree processing services in Surat: Lace Patti / Border Work, Diamond Work, Hotfix Stones, Roll Polish, and Dhaga Cutting.')

@section('content')

<!-- Header Banner -->
<section class="py-5" style="background: radial-gradient(circle at 10% 20%, #172554 0%, #0b1329 100%); color: #ffffff;">
    <div class="container py-2 py-md-3">
        <span class="section-tag section-tag-dark mb-2">Textile Value-Addition</span>
        <h1 class="display-6 fw-bold text-white font-cinzel mb-2">Our Saree Processing Services</h1>
        <p class="text-light opacity-75 mb-0" style="max-width: 650px;">
            Comprehensive value-added craftsmanship tailored for textile merchants and saree traders in Surat, Gujarat.
        </p>
    </div>
</section>

<!-- Requirement Note Banner -->
<section class="py-3 bg-light border-bottom">
    <div class="container">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-info-circle-fill text-warning fs-5 flex-shrink-0" aria-hidden="true"></i>
            <div class="small text-muted">
                <strong class="text-dark">Requirement-Based Processing:</strong> {{ $settings->process_note ?? 'Services are customized according to each saree design and merchant requirements. Not every saree requires every service.' }}
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-5 bg-white">
    <div class="container py-3 py-md-4">
        <div class="row g-4">
            @forelse($services as $service)
                <div class="col-lg-6">
                    <div class="card h-100 premium-card p-4 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="service-icon-box">
                                        <i class="bi {{ $service->icon ?? 'bi-gem' }}" aria-hidden="true"></i>
                                    </div>
                                    <div>
                                        <h2 class="h4 fw-bold text-black mb-0 font-cinzel" style="color: #000000 !important;">{{ $service->title }}</h2>
                                        <span class="badge bg-secondary-subtle text-secondary small">Service #{{ $service->display_order }}</span>
                                    </div>
                                </div>
                            </div>

                            @if($service->image_path)
                                <div class="mb-3 rounded-4 overflow-hidden" style="max-height: 220px; background: #f1f5f9;">
                                    <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="w-100 h-100 object-fit-cover" loading="lazy">
                                </div>
                            @endif

                            <p class="text-muted mb-3" style="line-height: 1.7;">
                                {{ $service->short_description }}
                            </p>

                            @if($service->full_description)
                                <p class="text-secondary small mb-3 opacity-90" style="line-height: 1.6;">
                                    {{ Str::limit($service->full_description, 160) }}
                                </p>
                            @endif
                        </div>

                        <div class="pt-3 border-top d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center justify-content-between gap-2">
                            <a href="{{ route('services.show', $service) }}" class="btn btn-outline-secondary btn-sm px-3">
                                Learn More Details <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('contact') }}?service={{ urlencode($service->title) }}" class="btn btn-gold btn-sm px-3">
                                Enquire for Bulk Lot
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    Saree services are currently being updated.
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
