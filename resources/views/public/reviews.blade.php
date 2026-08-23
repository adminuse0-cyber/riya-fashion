@extends('layouts.public')

@section('title', 'Merchant Reviews & Feedback — ' . ($settings->business_name ?? 'Riya Fashion'))
@section('meta_description', 'Read genuine reviews and feedback from Surat textile merchants who partner with Riya Fashion for saree processing and value-addition.')

@section('content')

<!-- Header Banner -->
<section class="py-5" style="background: radial-gradient(circle at 10% 20%, #172554 0%, #0b1329 100%); color: #ffffff;">
    <div class="container py-2 py-md-3">
        <span class="section-tag section-tag-dark mb-2">Merchant Trust</span>
        <h1 class="display-6 fw-bold text-white font-cinzel mb-2">Merchant Reviews & Feedback</h1>
        <p class="text-light opacity-75 mb-0" style="max-width: 650px;">
            Authentic feedback from textile merchants and saree traders who work with Riya Fashion in Surat.
        </p>
    </div>
</section>

<!-- Authenticity Policy Banner -->
<section class="py-3 bg-light border-bottom">
    <div class="container">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-shield-check text-warning fs-4 flex-shrink-0" aria-hidden="true"></i>
            <div class="small text-muted">
                <strong class="text-dark">Strict Authenticity Policy:</strong> Riya Fashion publishes only genuine feedback received from actual textile merchants. We do not use fabricated testimonials, automated bot ratings, or artificial endorsements.
            </div>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="py-5 bg-white">
    <div class="container py-3 py-md-4">
        @if($reviews->count() > 0)
            <div class="row g-4">
                @foreach($reviews as $review)
                    <div class="col-lg-6">
                        <div class="card h-100 premium-card p-4 d-flex flex-column justify-content-between">
                            <div>
                                @if($review->rating)
                                    <div class="d-flex align-items-center gap-1 text-warning mb-3" aria-label="{{ $review->rating }} out of 5 stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} {{ $i <= $review->rating ? 'text-warning' : 'text-muted opacity-25' }}" aria-hidden="true"></i>
                                        @endfor
                                        <span class="small text-muted ms-2 fw-semibold">({{ $review->rating }}/5)</span>
                                    </div>
                                @endif

                                <p class="text-secondary small fst-italic mb-4" style="line-height: 1.8; font-size: 14.5px;">
                                    "{{ $review->review_text }}"
                                </p>
                            </div>

                            <div class="pt-3 border-top d-flex align-items-center gap-3">
                                <div class="p-2 bg-light rounded-circle text-primary border"><i class="bi bi-person-fill fs-5" aria-hidden="true"></i></div>
                                <div>
                                    <h2 class="h6 fw-bold text-dark mb-0">{{ $review->client_name }}</h2>
                                    <div class="text-muted small">
                                        {{ $review->company_name ? $review->company_name . ' • ' : '' }}{{ $review->location }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Truthful Empty State -->
            <div class="text-center py-5 px-3 mx-auto" style="max-width: 600px;">
                <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle shadow-sm mb-3" style="width: 72px; height: 72px;">
                    <i class="bi bi-chat-quote text-muted fs-2" aria-hidden="true"></i>
                </div>
                <h2 class="h4 fw-bold text-dark mb-2 font-cinzel">Merchant Feedback</h2>
                <p class="text-muted small mb-4" style="line-height: 1.8;">
                    Merchant feedback will be added here as genuine reviews become available. Riya Fashion prioritizes verified business relationships over fabricated online ratings.
                </p>
                <a href="{{ route('contact') }}" class="btn btn-gold btn-sm px-4">
                    Connect with Our Workshop
                </a>
            </div>
        @endif
    </div>
</section>

@endsection
