@extends('layouts.admin')

@section('title', 'Edit Gallery Photograph')
@section('page-header', 'Edit Gallery Photograph')

@section('content')
<div class="container-fluid p-0">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1 font-cinzel">
                <i class="bi bi-pencil-square text-primary me-2"></i> Edit: {{ $gallery->title }}
            </h4>
            <p class="text-muted small mb-0">Update the caption, category, description, or replace the photograph.</p>
        </div>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary btn-sm px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Gallery
        </a>
    </div>

    <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Main Fields -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Photograph Information</h5>

                    <!-- Title / Caption -->
                    <div class="mb-3">
                        <label for="title" class="form-label small fw-semibold">Photo Title / Caption <span class="text-danger">*</span></label>
                        <input type="text"
                               name="title"
                               id="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $gallery->title) }}"
                               required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category" class="form-label small fw-semibold">Category <span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-select @error('category') is-invalid @enderror" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category', $gallery->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                            <option value="Other" {{ old('category', $gallery->category) === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-2">
                        <label for="description" class="form-label small fw-semibold">Description (Optional)</label>
                        <textarea name="description"
                                  id="description"
                                  rows="3"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $gallery->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <!-- Settings & Image Sidebar -->
            <div class="col-lg-4">
                <!-- Current Image -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Photograph</h5>

                    <!-- Current Image Preview -->
                    <div class="mb-3 text-center rounded-4 overflow-hidden bg-light border" style="height: 180px;">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}"
                             alt="{{ $gallery->title }}"
                             class="w-100 h-100 object-fit-cover">
                    </div>

                    <!-- Replace Image -->
                    <div class="mb-2">
                        <label for="image" class="form-label small fw-semibold">Replace with New Photograph</label>
                        <input type="file"
                               name="image"
                               id="image"
                               class="form-control form-control-sm @error('image') is-invalid @enderror"
                               accept=".jpg,.jpeg,.png,.webp">
                        <div class="form-text" style="font-size: 11px;">Allowed: JPG, JPEG, PNG, WEBP (Max 2MB). Leave empty to keep current image.</div>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- New Preview (hidden until upload) -->
                    <div id="imagePreviewContainer" class="d-none text-center p-2 bg-light rounded-3 border">
                        <img id="imagePreview" src="#" alt="New Preview" class="img-fluid rounded-3" style="max-height: 140px;">
                        <div class="small text-muted mt-1">New Photograph Preview</div>
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
                               value="{{ old('display_order', $gallery->display_order) }}"
                               min="0"
                               required>
                        @error('display_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold small" for="is_active">
                            Visible on Live Website
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-light text-center">
                    <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">
                        <i class="bi bi-check-circle-fill me-1"></i> Save Changes
                    </button>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-link text-muted small mt-2 text-decoration-none">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Image replacement preview
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const previewImg = document.getElementById('imagePreview');

    if (imageInput && previewContainer && previewImg) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
