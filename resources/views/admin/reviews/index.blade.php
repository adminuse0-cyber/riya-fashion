@extends('layouts.admin')

@section('title', 'Client Reviews Management')
@section('page-header', 'Client Reviews Management')

@section('content')
<div class="container-fluid p-0">

    <!-- Header & Action Bar -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1 font-cinzel">
                <i class="bi bi-chat-quote-fill text-primary me-2"></i> Merchant Reviews & Testimonials
            </h4>
            <p class="text-muted small mb-0">
                Manage genuine feedback received from Surat textile merchants. Only real, verified reviews may be entered.
            </p>
        </div>
        <div>
            <a href="{{ route('admin.reviews.create') }}" class="btn btn-gold btn-sm px-4 py-2">
                <i class="bi bi-plus-circle-fill me-1"></i> Add Review
            </a>
        </div>
    </div>

    <!-- Truthfulness Reminder Banner -->
    <div class="alert alert-light border border-warning-subtle shadow-sm rounded-4 p-3 mb-4 d-flex align-items-center gap-3">
        <div class="bg-warning-subtle text-warning-emphasis p-2 rounded-3 fs-5 flex-shrink-0">
            <i class="bi bi-shield-check-fill"></i>
        </div>
        <div class="small text-muted">
            <strong class="text-dark">Genuine Reviews Only:</strong> Only enter real feedback received directly from textile merchants and traders. Do not create fake testimonials, fabricated ratings, or invented merchant names. The review list starts empty and should only be populated with authentic feedback.
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
                <div class="fw-bold fs-3 text-dark">{{ $totalPublished + $totalDraft }}</div>
                <div class="small text-muted">Total Reviews</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
                <div class="fw-bold fs-3 text-success">{{ $totalPublished }}</div>
                <div class="small text-muted">Published</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
                <div class="fw-bold fs-3 text-secondary">{{ $totalDraft }}</div>
                <div class="small text-muted">Drafts</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
                <div class="fw-bold fs-3 text-warning">
                    @php
                        $avgRating = \App\Models\ClientReview::whereNotNull('rating')->avg('rating');
                    @endphp
                    {{ $avgRating ? number_format($avgRating, 1) : '—' }}
                </div>
                <div class="small text-muted">Avg. Rating</div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">
        <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm {{ $filter === 'all' ? 'btn-gold' : 'btn-outline-secondary' }} px-3">
            All ({{ $totalPublished + $totalDraft }})
        </a>
        <a href="{{ route('admin.reviews.index', ['filter' => 'published']) }}" class="btn btn-sm {{ $filter === 'published' ? 'btn-success' : 'btn-outline-success' }} px-3">
            <i class="bi bi-eye-fill me-1"></i> Published ({{ $totalPublished }})
        </a>
        <a href="{{ route('admin.reviews.index', ['filter' => 'draft']) }}" class="btn btn-sm {{ $filter === 'draft' ? 'btn-secondary' : 'btn-outline-secondary' }} px-3">
            <i class="bi bi-pencil me-1"></i> Drafts ({{ $totalDraft }})
        </a>
    </div>

    <!-- Reviews Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
            <h6 class="fw-bold text-dark mb-0">
                @if($filter === 'published') Published Reviews
                @elseif($filter === 'draft') Draft Reviews
                @else All Reviews
                @endif
                ({{ $reviews->count() }})
            </h6>
            <span class="badge bg-light text-dark border small">Sorted by Display Order</span>
        </div>

        @if($reviews->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px;">Order</th>
                            <th>Merchant / Review</th>
                            <th style="width: 130px;">Rating</th>
                            <th style="width: 120px;" class="text-center">Status</th>
                            <th style="width: 170px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            <tr>
                                <!-- Display Order -->
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis border px-2 py-1">
                                        #{{ $review->display_order }}
                                    </span>
                                </td>

                                <!-- Merchant Info & Review -->
                                <td>
                                    <div class="fw-bold text-dark">{{ $review->client_name }}</div>
                                    @if($review->company_name)
                                        <div class="text-muted small">{{ $review->company_name }}</div>
                                    @endif
                                    <div class="text-muted small">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $review->location }}
                                    </div>
                                    <div class="text-secondary mt-1" style="font-size: 13px; line-height: 1.45; max-width: 500px;">
                                        "{{ Str::limit($review->review_text, 120) }}"
                                    </div>
                                </td>

                                <!-- Star Rating -->
                                <td>
                                    @if($review->rating)
                                        <div class="d-flex align-items-center gap-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}" style="font-size: 13px;"></i>
                                            @endfor
                                            <span class="small text-muted ms-1">({{ $review->rating }}/5)</span>
                                        </div>
                                    @else
                                        <span class="text-muted small fst-italic">No rating</span>
                                    @endif
                                </td>

                                <!-- Published Status + Toggle -->
                                <td class="text-center">
                                    <form action="{{ route('admin.reviews.toggle-status', $review) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        @if($review->is_published)
                                            <button type="submit" class="btn btn-sm btn-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-semibold" title="Click to Unpublish" style="font-size: 12px;">
                                                <i class="bi bi-check-circle-fill me-1"></i> Published
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3 py-1 fw-semibold" title="Click to Publish" style="font-size: 12px;">
                                                <i class="bi bi-pencil-fill me-1"></i> Draft
                                            </button>
                                        @endif
                                    </form>
                                </td>

                                <!-- Actions -->
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.reviews.edit', $review) }}" class="btn btn-light border" title="Edit Review">
                                            <i class="bi bi-pencil-square text-primary"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-light border text-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $review->id }}"
                                                title="Delete Review">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $review->id }}" tabindex="-1" aria-labelledby="deleteLabel{{ $review->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-lg rounded-4 text-start">
                                                <div class="modal-header border-bottom">
                                                    <h5 class="modal-title fw-bold text-dark" id="deleteLabel{{ $review->id }}">
                                                        Confirm Delete Review
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body py-4">
                                                    <p class="mb-1">Delete review from <strong>{{ $review->client_name }}</strong>?</p>
                                                    <p class="text-danger small mb-0">
                                                        <i class="bi bi-exclamation-triangle me-1"></i> This cannot be undone.
                                                    </p>
                                                </div>
                                                <div class="modal-footer border-top bg-light">
                                                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm px-3">Yes, Delete Review</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5 px-3">
                <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle shadow-sm mb-3" style="width: 64px; height: 64px;">
                    <i class="bi bi-chat-quote text-muted fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">
                    @if($filter === 'published') No Published Reviews Yet
                    @elseif($filter === 'draft') No Draft Reviews
                    @else No Reviews Yet
                    @endif
                </h6>
                <p class="text-muted small mb-3" style="max-width: 480px; margin: 0 auto;">
                    @if($filter !== 'all')
                        No reviews match this filter. <a href="{{ route('admin.reviews.index') }}">View all reviews</a>.
                    @else
                        Once genuine feedback is received from Surat textile merchants, it can be entered here. The review list remains empty until real reviews are available.
                    @endif
                </p>
                @if($filter === 'all')
                    <a href="{{ route('admin.reviews.create') }}" class="btn btn-gold btn-sm px-4">
                        <i class="bi bi-plus-circle-fill me-1"></i> Add First Review
                    </a>
                @endif
            </div>
        @endif
    </div>

</div>
@endsection
