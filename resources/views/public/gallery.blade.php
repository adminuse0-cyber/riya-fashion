@extends('layouts.public')

@section('title', 'Photo Gallery — ' . ($settings->business_name ?? 'Riya Fashion') . ' | Saree Work & Workshop')
@section('meta_description', 'View authentic photographs of completed saree embellishments, lace patti, diamond work, and the workshop at Riya Fashion in Punagam, Surat.')

@section('content')

<!-- Header Banner -->
<section class="py-5" style="background: radial-gradient(circle at 10% 20%, #172554 0%, #0b1329 100%); color: #ffffff;">
    <div class="container py-2 py-md-3">
        <span class="section-tag section-tag-dark mb-2">Visual Craftsmanship</span>
        <h1 class="display-6 fw-bold text-white font-cinzel mb-2">Workshop & Saree Work Gallery</h1>
        <p class="text-light opacity-75 mb-0" style="max-width: 650px;">
            Authentic photographs of completed value-added saree work, embellishment placement, and our Surat workshop.
        </p>
    </div>
</section>

<!-- Category Filter Bar -->
<section class="py-3 bg-light border-bottom">
    <div class="container">
        <div class="d-flex align-items-center gap-2 flex-wrap justify-content-center justify-content-md-start">
            <span class="small text-muted fw-semibold me-1"><i class="bi bi-funnel-fill text-warning" aria-hidden="true"></i> Category:</span>
            <a href="{{ route('gallery') }}" 
               class="btn btn-sm {{ empty($selectedCategory) || $selectedCategory === 'All' ? 'btn-gold' : 'btn-outline-secondary bg-white' }} px-3 py-1" style="min-height: 34px;">
                All Photos
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('gallery', ['category' => $cat]) }}" 
                   class="btn btn-sm {{ $selectedCategory === $cat ? 'btn-gold' : 'btn-outline-secondary bg-white' }} px-3 py-1" style="min-height: 34px;">
                    {{ $cat }}
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-5 bg-white">
    <div class="container py-3 py-md-4">
        @if($galleryItems->count() > 0)
            <div class="row g-4">
                @foreach($galleryItems as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card h-100 border shadow-sm rounded-4 overflow-hidden premium-card">
                            <div style="height: 240px; background: #e2e8f0; overflow: hidden;">
                                <img src="{{ asset('storage/' . $item->image_path) }}" 
                                     alt="{{ $item->title }}" 
                                     class="w-100 h-100 object-fit-cover" 
                                     loading="lazy">
                            </div>
                            <div class="card-body p-3">
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle small mb-2">
                                    {{ $item->category }}
                                </span>
                                <h2 class="h6 fw-bold text-dark mb-1">{{ $item->title }}</h2>
                                @if($item->description)
                                    <p class="text-muted small mb-0 mt-1" style="line-height: 1.5;">
                                        {{ $item->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Truthful Empty State -->
            <div class="text-center py-5 px-3 mx-auto" style="max-width: 600px;">
                <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle shadow-sm mb-3" style="width: 72px; height: 72px;">
                    <i class="bi bi-camera text-muted fs-2" aria-hidden="true"></i>
                </div>
                <h2 class="h5 fw-bold text-dark mb-2">No Photographs in This Category</h2>
                <p class="text-muted small mb-4" style="line-height: 1.7;">
                    Riya Fashion maintains strict authenticity by displaying only real photographs of completed merchant saree lots and our active workshop facility. New photos are uploaded as work lots are processed.
                </p>
                <a href="{{ route('gallery') }}" class="btn btn-outline-secondary btn-sm px-4">
                    View All Categories
                </a>
            </div>
        @endif
    </div>
</section>

@endsection
