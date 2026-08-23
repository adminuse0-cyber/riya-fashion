@extends('layouts.admin')

@section('title', 'Upload Gallery Photograph')
@section('page-header', 'Upload Gallery Photograph')

@section('content')
<div class="container-fluid p-0">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1 font-cinzel">
                <i class="bi bi-cloud-upload text-primary me-2"></i> Upload New Photograph
            </h4>
            <p class="text-muted small mb-0">Add an authentic photo of completed saree work, the workshop, or the office.</p>
        </div>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary btn-sm px-3">
            <i class="bi bi-arrow-left me-1"></i> Back to Gallery
        </a>
    </div>

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf

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
                               value="{{ old('title') }}"
                               placeholder="e.g. Diamond Work on Georgette Saree — Surat"
                               required autofocus>
                        <div class="form-text" style="font-size: 11px;">Give a brief, factual caption describing what is shown.</div>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category" class="form-label small fw-semibold">Category <span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-select @error('category') is-invalid @enderror" required>
                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>— Select a category —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                            <option value="Other" {{ old('category') === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-2">
                        <label for="description" class="form-label small fw-semibold">Description (Optional)</label>
                        <textarea name="description"
                                  id="description"
                                  rows="3"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Optional — briefly describe the saree type, work technique, or merchant specification used">{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <!-- Settings & Image Sidebar -->
            <div class="col-lg-4">
                <!-- Image Upload -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h5 class="fw-bold text-dark mb-3 border-bottom pb-2">Photograph Upload <span class="text-danger">*</span></h5>

                    <!-- Drop Zone / Upload Area -->
                    <div id="dropZone" class="border border-dashed border-2 rounded-4 p-4 text-center mb-3 position-relative" 
                         style="border-color: #94a3b8 !important; cursor: pointer; min-height: 160px; display: flex; flex-direction: column; align-items: center; justify-content: center; background: #f8fafc;">
                        <i class="bi bi-cloud-arrow-up-fill fs-1 text-muted mb-2"></i>
                        <div class="fw-semibold text-dark small mb-1">Click to browse or drag & drop</div>
                        <div class="text-muted" style="font-size: 11px;">JPG, JPEG, PNG or WEBP — Max 2 MB</div>
                        <input type="file" name="image" id="image" class="position-absolute top-0 start-0 w-100 h-100 opacity-0" accept=".jpg,.jpeg,.png,.webp" required style="cursor: pointer;">
                    </div>

                    @error('image') <div class="text-danger small mb-3">{{ $message }}</div> @enderror

                    <!-- Preview Box (hidden until upload) -->
                    <div id="imagePreviewContainer" class="d-none text-center p-2 bg-light rounded-4 border">
                        <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded-3" style="max-height: 180px;">
                        <div class="small text-muted mt-2">Preview</div>
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
                        <div class="form-text" style="font-size: 11px;">Lower numbers appear first in the gallery.</div>
                        @error('display_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold small" for="is_active">
                            Publish Immediately (Visible on Website)
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-light text-center">
                    <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">
                        <i class="bi bi-cloud-upload-fill me-1"></i> Upload Photograph
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
    // Image upload preview
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const previewImg = document.getElementById('imagePreview');
    const dropZone = document.getElementById('dropZone');

    if (imageInput) {
        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                    dropZone.style.minHeight = 'auto';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Drag hover highlight
    if (dropZone) {
        dropZone.addEventListener('dragover', function (e) {
            e.preventDefault();
            dropZone.style.background = '#e8f4fd';
            dropZone.style.borderColor = '#3b82f6 !important';
        });
        dropZone.addEventListener('dragleave', function () {
            dropZone.style.background = '#f8fafc';
        });
        dropZone.addEventListener('drop', function (e) {
            dropZone.style.background = '#f8fafc';
        });
    }
</script>
@endsection
