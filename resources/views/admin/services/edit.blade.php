@extends('layouts.admin')

@section('title', 'Edit Saree Processing Service')
@section('page-header', 'Edit Saree Processing Service')

@section('content')
<div class="container-fluid p-0">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1 font-cinzel">
                <i class="bi bi-pencil-square text-primary me-2"></i> Edit Service: {{ $service->title }}
            </h4>
            <p class="text-muted small mb-0">Update service descriptions, icon, order, or image.</p>
        </div>
        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary btn-sm px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Services
        </a>
    </div>

    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Main Details -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Service Details</h5>

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label small fw-semibold">Service Title <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title', $service->title) }}" 
                               required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Slug -->
                    <div class="mb-3">
                        <label for="slug" class="form-label small fw-semibold">URL Slug <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text small text-muted">/services/</span>
                            <input type="text" 
                                   name="slug" 
                                   id="slug" 
                                   class="form-control @error('slug') is-invalid @enderror" 
                                   value="{{ old('slug', $service->slug) }}" 
                                   required>
                        </div>
                        <div class="form-text" style="font-size: 11px;">URL-friendly slug (e.g. lace-patti-border-work).</div>
                        @error('slug') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>

                    <!-- Short Description -->
                    <div class="mb-3">
                        <label for="short_description" class="form-label small fw-semibold">Short Summary Description <span class="text-danger">*</span></label>
                        <textarea name="short_description" 
                                  id="short_description" 
                                  rows="3" 
                                  class="form-control @error('short_description') is-invalid @enderror" 
                                  required>{{ old('short_description', $service->short_description) }}</textarea>
                        @error('short_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Full Description -->
                    <div class="mb-2">
                        <label for="full_description" class="form-label small fw-semibold">Full Process Description (Optional)</label>
                        <textarea name="full_description" 
                                  id="full_description" 
                                  rows="5" 
                                  class="form-control @error('full_description') is-invalid @enderror">{{ old('full_description', $service->full_description) }}</textarea>
                        @error('full_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <!-- Settings & Image Sidebar -->
            <div class="col-lg-4">
                <!-- Icon & Order Card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Display Settings</h5>

                    <!-- Display Order -->
                    <div class="mb-3">
                        <label for="display_order" class="form-label small fw-semibold">Display Sequence Order <span class="text-danger">*</span></label>
                        <input type="number" 
                               name="display_order" 
                               id="display_order" 
                               class="form-control @error('display_order') is-invalid @enderror" 
                               value="{{ old('display_order', $service->display_order) }}" 
                               min="0" 
                               required>
                        <div class="form-text" style="font-size: 11px;">Lower numbers appear first.</div>
                        @error('display_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Bootstrap Icon -->
                    <div class="mb-3">
                        <label for="icon" class="form-label small fw-semibold">Bootstrap Icon Class</label>
                        <div class="input-group">
                            <span class="input-group-text" id="iconPreview"><i class="bi {{ $service->icon ?? 'bi-gem' }}"></i></span>
                            <input type="text" 
                                   name="icon" 
                                   id="icon" 
                                   class="form-control @error('icon') is-invalid @enderror" 
                                   value="{{ old('icon', $service->icon) }}" 
                                   placeholder="e.g. bi-scissors">
                        </div>
                        <div class="d-flex flex-wrap gap-1 mt-2">
                            <span class="badge bg-light text-dark border cursor-pointer icon-preset" data-icon="bi-scissors"><i class="bi bi-scissors"></i> scissors</span>
                            <span class="badge bg-light text-dark border cursor-pointer icon-preset" data-icon="bi-gem"><i class="bi bi-gem"></i> gem</span>
                            <span class="badge bg-light text-dark border cursor-pointer icon-preset" data-icon="bi-stars"><i class="bi bi-stars"></i> stars</span>
                            <span class="badge bg-light text-dark border cursor-pointer icon-preset" data-icon="bi-arrow-repeat"><i class="bi bi-arrow-repeat"></i> roll</span>
                            <span class="badge bg-light text-dark border cursor-pointer icon-preset" data-icon="bi-check2-circle"><i class="bi bi-check2-circle"></i> check</span>
                        </div>
                        @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Active Toggle -->
                    <div class="form-check form-switch pt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold small" for="is_active">
                            Published & Active on Website
                        </label>
                    </div>
                </div>

                <!-- Image Card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Service Image</h5>

                    @if($service->image_path)
                        <div class="mb-3 p-2 bg-light rounded-3 border text-center">
                            <img src="{{ asset('storage/' . $service->image_path) }}" alt="{{ $service->title }}" class="img-fluid rounded-3 mb-2" style="max-height: 140px;">
                            <div class="form-check text-start ps-4">
                                <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                                <label class="form-check-label small text-danger" for="remove_image">
                                    Remove current image
                                </label>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="image" class="form-label small fw-semibold">
                            {{ $service->image_path ? 'Replace Image' : 'Upload Image (Optional)' }}
                        </label>
                        <input type="file" 
                               name="image" 
                               id="image" 
                               class="form-control form-control-sm @error('image') is-invalid @enderror" 
                               accept=".jpg,.jpeg,.png,.webp">
                        <div class="form-text" style="font-size: 11px;">Allowed: JPG, JPEG, PNG, WEBP (Max 2MB).</div>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- New Preview Container -->
                    <div id="imagePreviewContainer" class="d-none text-center p-2 bg-light rounded-3 border">
                        <img id="imagePreview" src="#" alt="New Preview" class="img-fluid rounded-3" style="max-height: 140px;">
                        <div class="small text-muted mt-1">New Image Preview</div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-light text-center">
                    <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">
                        <i class="bi bi-check-circle-fill me-1"></i> Update Service
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-link text-muted small mt-2 text-decoration-none">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>

</div>

<script>
    // Icon preset clicker
    document.querySelectorAll('.icon-preset').forEach(function(badge) {
        badge.addEventListener('click', function() {
            const iconClass = this.getAttribute('data-icon');
            const iconInput = document.getElementById('icon');
            const iconPreview = document.getElementById('iconPreview');
            if (iconInput && iconPreview) {
                iconInput.value = iconClass;
                iconPreview.innerHTML = '<i class="bi ' + iconClass + '"></i>';
            }
        });
    });

    const iconInput = document.getElementById('icon');
    if (iconInput) {
        iconInput.addEventListener('input', function() {
            const iconPreview = document.getElementById('iconPreview');
            if (iconPreview) {
                iconPreview.innerHTML = '<i class="bi ' + (iconInput.value || 'bi-gem') + '"></i>';
            }
        });
    }

    // Image preview
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const previewImg = document.getElementById('imagePreview');

    if (imageInput && previewContainer && previewImg) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
