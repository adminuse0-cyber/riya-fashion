@extends('layouts.admin')

@section('title', 'Services Management')
@section('page-header', 'Services Management')

@section('content')
<div class="container-fluid p-0">

    <!-- Header & Action Bar -->
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1 font-cinzel">
                <i class="bi bi-scissors text-primary me-2"></i> Saree Processing Services
            </h4>
            <p class="text-muted small mb-0">
                Manage requirement-based value-added services offered to Surat textile merchants (Lace Patti, Diamond Work, Hotfix, Roll Polish, Dhaga Cutting).
            </p>
        </div>
        <div>
            <a href="{{ route('admin.services.create') }}" class="btn btn-gold btn-sm px-4 py-2">
                <i class="bi bi-plus-circle-fill me-1"></i> Add New Service
            </a>
        </div>
    </div>

    <!-- Requirement Notice Banner -->
    <div class="alert alert-light border border-warning-subtle shadow-sm rounded-4 p-3 mb-4 d-flex align-items-center gap-3">
        <div class="bg-warning-subtle text-warning-emphasis p-2 rounded-3 fs-5 flex-shrink-0">
            <i class="bi bi-info-circle-fill"></i>
        </div>
        <div class="small text-muted">
            <strong class="text-dark">Requirement-Based Workflow:</strong> Services are customized according to each saree design and merchant requirements. Not every saree requires every service. Use the active toggle below to control which services appear on the live website.
        </div>
    </div>

    <!-- Services Table Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
            <h6 class="fw-bold text-dark mb-0">
                All Saree Processing Services ({{ $services->count() }})
            </h6>
            <span class="badge bg-light text-dark border small">Sorted by Display Order</span>
        </div>

        @if($services->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 70px;">Order</th>
                            <th scope="col" style="width: 80px;">Image</th>
                            <th scope="col">Service Name & Slug</th>
                            <th scope="col">Short Description</th>
                            <th scope="col" style="width: 90px;" class="text-center">Icon</th>
                            <th scope="col" style="width: 120px;" class="text-center">Status</th>
                            <th scope="col" style="width: 160px;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <!-- Display Order -->
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis border px-2 py-1">
                                        #{{ $service->display_order }}
                                    </span>
                                </td>

                                <!-- Image Thumbnail -->
                                <td>
                                    @if($service->image_path)
                                        <img src="{{ asset('storage/' . $service->image_path) }}" 
                                             alt="{{ $service->title }}" 
                                             class="rounded-3 border object-fit-cover shadow-sm" 
                                             style="width: 52px; height: 52px;">
                                    @else
                                        <div class="rounded-3 bg-light border d-flex align-items-center justify-content-center text-muted" 
                                             style="width: 52px; height: 52px;" title="No custom image uploaded">
                                            <i class="bi {{ $service->icon ?? 'bi-gem' }} fs-5 text-secondary"></i>
                                        </div>
                                    @endif
                                </td>

                                <!-- Title & Slug -->
                                <td>
                                    <div class="fw-bold text-dark">{{ $service->title }}</div>
                                    <div class="text-muted" style="font-size: 11px;">
                                        <code>{{ $service->slug }}</code>
                                    </div>
                                </td>

                                <!-- Short Description -->
                                <td>
                                    <div class="text-muted small" style="max-width: 380px; line-height: 1.4;">
                                        {{ $service->short_description }}
                                    </div>
                                </td>

                                <!-- Icon -->
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-light border rounded-3 p-2 text-primary fs-5" style="width: 38px; height: 38px;">
                                        <i class="bi {{ $service->icon ?? 'bi-gem' }}"></i>
                                    </div>
                                </td>

                                <!-- Active Status & Toggle -->
                                <td class="text-center">
                                    <form action="{{ route('admin.services.toggle-status', $service) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        @if($service->is_active)
                                            <button type="submit" class="btn btn-sm btn-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-semibold" title="Click to Unpublish">
                                                <i class="bi bi-check-circle-fill me-1"></i> Active
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-sm btn-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3 py-1 fw-semibold" title="Click to Publish">
                                                <i class="bi bi-eye-slash-fill me-1"></i> Inactive
                                            </button>
                                        @endif
                                    </form>
                                </td>

                                <!-- Actions -->
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-light border" title="Edit Service">
                                            <i class="bi bi-pencil-square text-primary"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-light border text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $service->id }}" title="Delete Service">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="deleteModal{{ $service->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $service->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-lg rounded-4 text-start">
                                                <div class="modal-header border-bottom">
                                                    <h5 class="modal-title fw-bold text-dark" id="deleteModalLabel{{ $service->id }}">
                                                        Confirm Delete Service
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body py-4">
                                                    <p class="mb-2">Are you sure you want to delete the service: <strong>{{ $service->title }}</strong>?</p>
                                                    <p class="text-danger small mb-0">
                                                        <i class="bi bi-exclamation-triangle me-1"></i> This action cannot be undone and its associated image will be permanently removed from disk.
                                                    </p>
                                                </div>
                                                <div class="modal-footer border-top bg-light">
                                                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm px-3">
                                                            Yes, Delete Service
                                                        </button>
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
                    <i class="bi bi-scissors text-muted fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">No Services Configured Yet</h6>
                <p class="text-muted small mb-3" style="max-width: 440px; margin: 0 auto;">
                    Add your saree processing and value-addition services to display them for Surat textile merchants.
                </p>
                <a href="{{ route('admin.services.create') }}" class="btn btn-gold btn-sm px-4">
                    <i class="bi bi-plus-circle-fill me-1"></i> Add First Service
                </a>
            </div>
        @endif
    </div>

</div>
@endsection
