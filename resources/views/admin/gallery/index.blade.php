@extends('layouts.admin')

@section('title', 'Gallery Management')
@section('page-header', 'Gallery Management')

@section('content')
<div class="container-fluid p-0">

    <!-- Header & Action Bar -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1 font-cinzel">
                <i class="bi bi-images text-primary me-2"></i> Workshop & Work Gallery
            </h4>
            <p class="text-muted small mb-0">
                Upload real photographs of completed saree work, the workshop space, and the office to build credibility with Surat textile merchants.
            </p>
        </div>
        <div>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-gold btn-sm px-4 py-2">
                <i class="bi bi-cloud-upload-fill me-1"></i> Upload Photograph
            </a>
        </div>
    </div>

    <!-- Truthfulness Reminder Banner -->
    <div class="alert alert-light border border-warning-subtle shadow-sm rounded-4 p-3 mb-4 d-flex align-items-center gap-3">
        <div class="bg-warning-subtle text-warning-emphasis p-2 rounded-3 fs-5 flex-shrink-0">
            <i class="bi bi-camera-fill"></i>
        </div>
        <div class="small text-muted">
            <strong class="text-dark">Upload Only Real Photographs:</strong> This gallery is shown to Surat textile merchants for business credibility. Upload authentic photos of actual completed saree work, your workshop facility, or the office. Do not upload stock images or unrelated photos.
        </div>
    </div>

    <!-- Category Filter Bar -->
    <div class="card border-0 shadow-sm rounded-4 p-3 mb-4">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <span class="small text-muted fw-semibold me-1">Filter:</span>
            <a href="{{ route('admin.gallery.index') }}" 
               class="btn btn-sm {{ empty($selectedCategory) || $selectedCategory === 'All' ? 'btn-gold' : 'btn-outline-secondary' }} px-3">
                All ({{ $items->count() }})
            </a>
            @foreach($categories as $cat)
                @php $catCount = \App\Models\GalleryItem::where('category', $cat)->count(); @endphp
                @if($catCount > 0)
                <a href="{{ route('admin.gallery.index', ['category' => $cat]) }}"
                   class="btn btn-sm {{ $selectedCategory === $cat ? 'btn-gold' : 'btn-outline-secondary' }} px-3">
                    {{ $cat }} ({{ $catCount }})
                </a>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Gallery Grid Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
            <h6 class="fw-bold text-dark mb-0">
                {{ empty($selectedCategory) || $selectedCategory === 'All' ? 'All Photographs' : $selectedCategory }} 
                ({{ $items->count() }})
            </h6>
            <span class="badge bg-light text-dark border small">Sorted by Display Order</span>
        </div>

        @if($items->count() > 0)
            <div class="p-4">
                <div class="row g-3">
                    @foreach($items as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card h-100 border shadow-sm rounded-4 overflow-hidden position-relative gallery-card">
                            <!-- Status Badge -->
                            <div class="position-absolute top-0 end-0 m-2" style="z-index: 2;">
                                @if($item->is_active)
                                    <span class="badge bg-success rounded-pill shadow-sm small">
                                        <i class="bi bi-eye-fill me-1"></i> Visible
                                    </span>
                                @else
                                    <span class="badge bg-secondary rounded-pill shadow-sm small">
                                        <i class="bi bi-eye-slash-fill me-1"></i> Hidden
                                    </span>
                                @endif
                            </div>

                            <!-- Order Badge -->
                            <div class="position-absolute top-0 start-0 m-2" style="z-index: 2;">
                                <span class="badge bg-dark bg-opacity-50 rounded-pill shadow-sm small">
                                    #{{ $item->display_order }}
                                </span>
                            </div>

                            <!-- Photograph -->
                            <div class="overflow-hidden" style="height: 175px; background: #f1f5f9;">
                                <img src="{{ asset('storage/' . $item->image_path) }}" 
                                     alt="{{ $item->title }}" 
                                     class="w-100 h-100 object-fit-cover"
                                     style="transition: transform 0.3s ease;">
                            </div>

                            <div class="card-body p-3">
                                <!-- Category Badge -->
                                <span class="badge bg-primary-subtle text-primary-emphasis border border-primary-subtle small mb-1">
                                    {{ $item->category }}
                                </span>

                                <!-- Title -->
                                <h6 class="fw-bold text-dark mb-1 mt-1" style="font-size: 13px; line-height: 1.35;">
                                    {{ $item->title }}
                                </h6>

                                @if($item->description)
                                <p class="text-muted mb-0" style="font-size: 11px; line-height: 1.4;">
                                    {{ Str::limit($item->description, 70) }}
                                </p>
                                @endif
                            </div>

                            <!-- Action Footer -->
                            <div class="card-footer bg-light border-top p-2 d-flex gap-1 justify-content-between align-items-center">
                                <!-- Toggle Status -->
                                <form action="{{ route('admin.gallery.toggle-status', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $item->is_active ? 'btn-outline-success' : 'btn-outline-secondary' }} px-2 py-1" style="font-size: 11px;" title="{{ $item->is_active ? 'Click to Hide' : 'Click to Publish' }}">
                                        <i class="bi {{ $item->is_active ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                                        {{ $item->is_active ? 'Hide' : 'Show' }}
                                    </button>
                                </form>

                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-sm btn-light border px-2 py-1" title="Edit" style="font-size: 11px;">
                                        <i class="bi bi-pencil text-primary"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-light border px-2 py-1 text-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $item->id }}" 
                                            title="Delete" 
                                            style="font-size: 11px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content border-0 shadow-lg rounded-4 text-start">
                                        <div class="modal-header border-bottom">
                                            <h6 class="modal-title fw-bold text-dark" id="deleteLabel{{ $item->id }}">
                                                Delete Photograph?
                                            </h6>
                                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body py-3">
                                            <p class="small mb-1">Delete: <strong>{{ $item->title }}</strong>?</p>
                                            <p class="text-danger small mb-0">
                                                <i class="bi bi-exclamation-triangle me-1"></i> The image file will also be permanently deleted.
                                            </p>
                                        </div>
                                        <div class="modal-footer border-top bg-light py-2">
                                            <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm px-3">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5 px-3">
                <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle shadow-sm mb-3" style="width: 64px; height: 64px;">
                    <i class="bi bi-images text-muted fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">No Photographs Yet</h6>
                <p class="text-muted small mb-3" style="max-width: 440px; margin: 0 auto;">
                    Upload real photographs of completed saree embellishment work, your workshop, and office to build trust with textile merchants.
                </p>
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-gold btn-sm px-4">
                    <i class="bi bi-cloud-upload-fill me-1"></i> Upload First Photograph
                </a>
            </div>
        @endif
    </div>

</div>

<style>
    .gallery-card:hover img {
        transform: scale(1.04);
    }
</style>
@endsection
