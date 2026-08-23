@extends('layouts.admin')

@section('title', 'Add Merchant Review')
@section('page-header', 'Add Merchant Review')

@section('content')
<div class="container-fluid p-0">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1 font-cinzel">
                <i class="bi bi-plus-circle text-primary me-2"></i> Add Genuine Merchant Review
            </h4>
            <p class="text-muted small mb-0">Enter only real feedback received from actual textile merchants in Surat.</p>
        </div>
        <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary btn-sm px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Reviews
        </a>
    </div>

    <form action="{{ route('admin.reviews.store') }}" method="POST" autocomplete="off">
        @csrf

        <div class="row g-4">
            <!-- Main Review Content -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Review Details</h5>

                    <!-- Review Text -->
                    <div class="mb-3">
                        <label for="review_text" class="form-label small fw-semibold">Review / Testimonial Text <span class="text-danger">*</span></label>
                        <textarea name="review_text"
                                  id="review_text"
                                  rows="5"
                                  class="form-control @error('review_text') is-invalid @enderror"
                                  placeholder="Enter the exact words shared by the merchant, as closely as possible."
                                  required>{{ old('review_text') }}</textarea>
                        <div class="form-text" style="font-size: 11px;">Enter only genuine feedback received from the merchant. Do not paraphrase or invent content.</div>
                        @error('review_text') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Rating -->
                    <div class="mb-2">
                        <label class="form-label small fw-semibold">Star Rating (Optional)</label>
                        <div class="d-flex align-items-center gap-3">
                            <div class="star-rating d-flex gap-1" id="starRating">
                                @for($i = 1; $i <= 5; $i++)
                                    <label class="cursor-pointer" title="{{ $i }} star{{ $i > 1 ? 's' : '' }}" style="cursor: pointer;">
                                        <input type="radio" name="rating" value="{{ $i }}" class="d-none star-radio" {{ old('rating') == $i ? 'checked' : '' }}>
                                        <i class="bi bi-star{{ old('rating') >= $i ? '-fill' : '' }} fs-4 {{ old('rating') >= $i ? 'text-warning' : 'text-muted' }} star-icon" data-star="{{ $i }}"></i>
                                    </label>
                                @endfor
                            </div>
                            <div>
                                <button type="button" id="clearRating" class="btn btn-outline-secondary btn-sm py-0 px-2" style="font-size: 11px;">
                                    <i class="bi bi-x me-1"></i> No Rating
                                </button>
                            </div>
                        </div>
                        <div class="form-text" style="font-size: 11px;">Only enter a rating if the merchant explicitly gave one. Leave blank if not provided.</div>
                        @error('rating') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <!-- Merchant Info Sidebar -->
            <div class="col-lg-4">
                <!-- Merchant Identity -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Merchant Information</h5>

                    <div class="mb-3">
                        <label for="client_name" class="form-label small fw-semibold">Merchant / Client Name <span class="text-danger">*</span></label>
                        <input type="text"
                               name="client_name"
                               id="client_name"
                               class="form-control @error('client_name') is-invalid @enderror"
                               value="{{ old('client_name') }}"
                               placeholder="e.g. Ramesh Bhai"
                               required autofocus>
                        <div class="form-text" style="font-size: 11px;">Use only if the merchant has consented to their name being displayed.</div>
                        @error('client_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="company_name" class="form-label small fw-semibold">Company / Firm Name (Optional)</label>
                        <input type="text"
                               name="company_name"
                               id="company_name"
                               class="form-control @error('company_name') is-invalid @enderror"
                               value="{{ old('company_name') }}"
                               placeholder="e.g. Shree Textiles">
                        <div class="form-text" style="font-size: 11px;">Leave blank to protect merchant privacy.</div>
                        @error('company_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-2">
                        <label for="location" class="form-label small fw-semibold">Location <span class="text-danger">*</span></label>
                        <input type="text"
                               name="location"
                               id="location"
                               class="form-control @error('location') is-invalid @enderror"
                               value="{{ old('location', 'Surat, Gujarat') }}"
                               placeholder="e.g. Surat, Gujarat"
                               required>
                        @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Display Settings -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Display Settings</h5>

                    <div class="mb-3">
                        <label for="display_order" class="form-label small fw-semibold">Display Order <span class="text-danger">*</span></label>
                        <input type="number"
                               name="display_order"
                               id="display_order"
                               class="form-control @error('display_order') is-invalid @enderror"
                               value="{{ old('display_order', $nextOrder) }}"
                               min="0"
                               required>
                        <div class="form-text" style="font-size: 11px;">Lower numbers appear first.</div>
                        @error('display_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold small" for="is_published">
                            Publish on Live Website
                        </label>
                    </div>
                    <div class="form-text mt-1" style="font-size: 11px;">Unpublished reviews are saved as drafts and not shown on the public website.</div>
                </div>

                <!-- Action Buttons -->
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-light text-center">
                    <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">
                        <i class="bi bi-check-circle-fill me-1"></i> Save Review
                    </button>
                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-link text-muted small mt-2 text-decoration-none">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Interactive star rating
    const starIcons = document.querySelectorAll('.star-icon');
    const starRadios = document.querySelectorAll('.star-radio');

    function updateStarDisplay(selectedValue) {
        starIcons.forEach(function(icon) {
            const star = parseInt(icon.getAttribute('data-star'));
            if (star <= selectedValue) {
                icon.classList.remove('bi-star', 'text-muted');
                icon.classList.add('bi-star-fill', 'text-warning');
            } else {
                icon.classList.remove('bi-star-fill', 'text-warning');
                icon.classList.add('bi-star', 'text-muted');
            }
        });
    }

    starRadios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            updateStarDisplay(parseInt(this.value));
        });
    });

    starIcons.forEach(function(icon) {
        icon.addEventListener('mouseover', function() {
            updateStarDisplay(parseInt(this.getAttribute('data-star')));
        });

        icon.closest('label').parentElement.addEventListener('mouseleave', function() {
            const checkedRadio = document.querySelector('.star-radio:checked');
            updateStarDisplay(checkedRadio ? parseInt(checkedRadio.value) : 0);
        });
    });

    // Clear rating button
    const clearBtn = document.getElementById('clearRating');
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            starRadios.forEach(function(r) { r.checked = false; });
            updateStarDisplay(0);
        });
    }
</script>
@endsection
