@extends('layouts.admin')

@section('title', 'Dashboard Overview')
@section('page-header', 'Dashboard Overview')

@section('content')
<div class="container-fluid p-0">

    <!-- Top Welcome Banner -->
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #0b1329 0%, #1a274c 100%); color: #ffffff;">
        <div class="card-body p-4 p-md-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-3" style="background: rgba(197, 155, 39, 0.2); border: 1px solid #c59b27; color: #dfb743; font-size: 12px; font-weight: 600;">
                        <i class="bi bi-shield-check"></i> Surat Textile Hub • B2B Management Portal
                    </div>
                    <h2 class="fw-bold mb-2 font-cinzel">Welcome back, {{ Auth::user()->name }}</h2>
                    <p class="mb-0" style="color: #cbd5e1; max-width: 680px; font-size: 14px; line-height: 1.6;">
                        Manage business information, saree processing services, authentic work photos, and merchant enquiries for <strong>{{ $settings->business_name }}</strong> from this central administrative dashboard.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <a href="{{ route('admin.business.index') }}" class="btn btn-gold px-4 py-2">
                        <i class="bi bi-gear-fill me-1"></i> Edit Business Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 5 Real Database-Driven KPI Metric Cards -->
    <div class="row g-3 mb-4">
        <!-- Active Services -->
        <div class="col-sm-6 col-xl">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-wrapper" style="background: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                        <i class="bi bi-scissors"></i>
                    </div>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1 small">
                        Services
                    </span>
                </div>
                <h3 class="fw-bold mb-1">{{ $servicesCount }}</h3>
                <div class="text-muted small d-flex align-items-center justify-content-between">
                    <span>Active Saree Work</span>
                    <a href="{{ route('admin.services.index') }}" class="text-decoration-none text-primary small fw-semibold">
                        View <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Gallery Photos -->
        <div class="col-sm-6 col-xl">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-wrapper" style="background: rgba(25, 135, 84, 0.1); color: #198754;">
                        <i class="bi bi-images"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small">
                        Gallery
                    </span>
                </div>
                <h3 class="fw-bold mb-1">{{ $galleryCount }}</h3>
                <div class="text-muted small d-flex align-items-center justify-content-between">
                    <span>Authentic Photos</span>
                    <a href="{{ route('admin.gallery.index') }}" class="text-decoration-none text-success small fw-semibold">
                        View <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Published Reviews (Starts 0 - Strict Truthfulness) -->
        <div class="col-sm-6 col-xl">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-wrapper" style="background: rgba(255, 193, 7, 0.15); color: #b45309;">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2 py-1 small">
                        Reviews
                    </span>
                </div>
                <h3 class="fw-bold mb-1">{{ $reviewsCount }}</h3>
                <div class="text-muted small d-flex align-items-center justify-content-between">
                    <span>Published Reviews</span>
                    <a href="{{ route('admin.reviews.index') }}" class="text-decoration-none text-warning-emphasis small fw-semibold">
                        Manage <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Unread Contact Messages -->
        <div class="col-sm-6 col-xl">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-wrapper" style="background: rgba(220, 53, 69, 0.1); color: #dc3545;">
                        <i class="bi bi-chat-left-dots-fill"></i>
                    </div>
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 small">
                        Unread
                    </span>
                </div>
                <h3 class="fw-bold mb-1">{{ $unreadMessagesCount }}</h3>
                <div class="text-muted small d-flex align-items-center justify-content-between">
                    <span>New Enquiries</span>
                    <a href="{{ route('admin.messages.index') }}" class="text-decoration-none text-danger small fw-semibold">
                        Inbox <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Total Contact Enquiries -->
        <div class="col-sm-6 col-xl">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-wrapper" style="background: rgba(108, 117, 125, 0.1); color: #495057;">
                        <i class="bi bi-inbox-fill"></i>
                    </div>
                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-2 py-1 small">
                        Total
                    </span>
                </div>
                <h3 class="fw-bold mb-1">{{ $totalMessagesCount }}</h3>
                <div class="text-muted small d-flex align-items-center justify-content-between">
                    <span>Total Submissions</span>
                    <a href="{{ route('admin.messages.index') }}" class="text-decoration-none text-secondary small fw-semibold">
                        View All <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Middle Section: Business Profile Snapshot & Quick Actions -->
    <div class="row g-4 mb-4">
        <!-- Business Profile Snapshot -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold text-dark mb-0">
                        <i class="bi bi-building me-2 text-primary"></i> Business Profile Snapshot
                    </h5>
                    <span class="badge bg-light text-dark border px-3 py-2">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $settings->target_market }}
                    </span>
                </div>

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small mb-1">Business Name</div>
                            <div class="fw-bold text-dark">{{ $settings->business_name }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small mb-1">Owner / Proprietor</div>
                            <div class="fw-bold text-dark">{{ $settings->owner_name }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small mb-1">Industry Experience</div>
                            <div class="fw-bold text-dark">{{ $settings->experience_years }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small mb-1">Target Market</div>
                            <div class="fw-bold text-dark">{{ $settings->target_market }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small mb-1">City / State</div>
                            <div class="fw-semibold text-dark">{{ $settings->city }}, {{ $settings->state }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small mb-1">Working Hours</div>
                            <div class="fw-semibold text-dark text-truncate">{{ $settings->business_hours }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 bg-light rounded-3">
                            <div class="text-muted small mb-1">Confirmed Workshop & Office Location</div>
                            <div class="fw-medium text-dark small">
                                <i class="bi bi-pin-map-fill text-danger me-1"></i>
                                {{ $settings->address_line }}, {{ $settings->city }}, {{ $settings->state }} - {{ $settings->pincode }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 pt-2 text-end">
                    <a href="{{ route('admin.business.index') }}" class="btn btn-outline-primary btn-sm px-3">
                        <i class="bi bi-pencil-square me-1"></i> Edit Business Information
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Management Actions -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4">
                <h5 class="fw-bold text-dark mb-3">
                    <i class="bi bi-lightning-charge-fill me-2 text-warning"></i> Quick Management Actions
                </h5>

                <div class="d-grid gap-2">
                    <a href="{{ route('admin.business.index') }}" class="btn btn-light text-start border p-3 rounded-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-sliders fs-4 text-primary"></i>
                            <div>
                                <div class="fw-semibold text-dark">Edit Business Information</div>
                                <div class="text-muted small">Phone, WhatsApp CTA, Address, Hours, Story</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>

                    <a href="{{ route('admin.services.index') }}" class="btn btn-light text-start border p-3 rounded-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-scissors fs-4 text-success"></i>
                            <div>
                                <div class="fw-semibold text-dark">Manage Services</div>
                                <div class="text-muted small">Lace Patti, Diamond, Hotfix, Roll Polish, Dhaga Cutting</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>

                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-light text-start border p-3 rounded-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-cloud-arrow-up fs-4 text-warning"></i>
                            <div>
                                <div class="fw-semibold text-dark">Manage Gallery</div>
                                <div class="text-muted small">Upload authentic saree work & workshop photos</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>

                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-light text-start border p-3 rounded-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-star fs-4 text-secondary"></i>
                            <div>
                                <div class="fw-semibold text-dark">Manage Reviews</div>
                                <div class="text-muted small">Publish verified merchant testimonials</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>

                    <a href="{{ route('admin.messages.index') }}" class="btn btn-light text-start border p-3 rounded-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-chat-left-dots fs-4 text-danger"></i>
                            <div>
                                <div class="fw-semibold text-dark">View Contact Messages</div>
                                <div class="text-muted small">Review incoming merchant quote & bulk requests</div>
                            </div>
                        </div>
                        <i class="bi bi-chevron-right text-muted"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Merchant Enquiries Section -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2 mb-3">
            <div>
                <h5 class="fw-bold text-dark mb-1">
                    <i class="bi bi-inbox-fill me-2 text-danger"></i> Recent Contact Enquiries
                </h5>
                <p class="text-muted small mb-0">Direct queries submitted by Surat textile merchants and traders via the website</p>
            </div>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm px-3">
                View All Messages ({{ $totalMessagesCount }})
            </a>
        </div>

        @if($recentMessages->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Merchant / Trader</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Contact Phone</th>
                            <th scope="col">Service Requested</th>
                            <th scope="col">Status</th>
                            <th scope="col">Received Date</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentMessages as $message)
                            <tr class="{{ !$message->is_read ? 'table-warning-subtle fw-semibold' : '' }}">
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if(!$message->is_read)
                                            <span class="badge bg-danger rounded-circle p-1" title="Unread Message"></span>
                                        @endif
                                        <span>{{ $message->merchant_name }}</span>
                                    </div>
                                </td>
                                <td>{{ $message->company_name ?? '—' }}</td>
                                <td>
                                    <a href="tel:{{ $message->phone }}" class="text-decoration-none text-dark">
                                        <i class="bi bi-telephone me-1 text-primary"></i> {{ $message->phone }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary-emphasis border">
                                        {{ $message->service_interested ?? 'General Work Enquiry' }}
                                    </span>
                                </td>
                                <td>
                                    @if($message->status === 'New')
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">New</span>
                                    @elseif($message->status === 'In Discussion')
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle">In Discussion</span>
                                    @elseif($message->status === 'Completed')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">Completed</span>
                                    @else
                                        <span class="badge bg-light text-dark border">{{ $message->status }}</span>
                                    @endif
                                </td>
                                <td class="text-muted small">
                                    {{ $message->created_at->format('d M Y, h:i A') }}
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.messages.index') }}" class="btn btn-light btn-sm border">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Truthful Empty State -->
            <div class="text-center py-5 px-3 bg-light rounded-4 my-2">
                <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mb-3" style="width: 64px; height: 64px;">
                    <i class="bi bi-chat-square-dots text-muted fs-3"></i>
                </div>
                <h6 class="fw-bold text-dark mb-1">No Enquiries Received Yet</h6>
                <p class="text-muted small mb-0" style="max-width: 460px; margin: 0 auto;">
                    When Surat textile merchants submit quote requests or bulk processing queries through the contact form, they will appear here in real-time.
                </p>
            </div>
        @endif
    </div>

    <!-- Bottom Row: Saree Processing Overview, Review Status & Gallery Status -->
    <div class="row g-4 mb-4">
        <!-- Seeded Services Status -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-bold text-dark mb-0">
                        <i class="bi bi-scissors me-1 text-primary"></i> Saree Processing Services ({{ $servicesCount }})
                    </h6>
                    <a href="{{ route('admin.services.index') }}" class="text-decoration-none small text-primary fw-semibold">
                        Manage
                    </a>
                </div>

                <ul class="list-group list-group-flush small">
                    @foreach($servicesList as $service)
                        <li class="list-group-item px-0 py-2 d-flex align-items-center justify-content-between bg-transparent">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi {{ $service->icon ?? 'bi-gem' }} text-secondary"></i>
                                <span class="fw-medium text-dark">{{ $service->title }}</span>
                            </div>
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">
                                Active
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Client Reviews Status (Strict Truthfulness - Starts Empty) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-bold text-dark mb-0">
                        <i class="bi bi-star me-1 text-warning"></i> Client Reviews Status
                    </h6>
                    <a href="{{ route('admin.reviews.index') }}" class="text-decoration-none small text-warning-emphasis fw-semibold">
                        Manage
                    </a>
                </div>

                @if($recentReviews->count() > 0)
                    <div class="list-group list-group-flush small">
                        @foreach($recentReviews as $review)
                            <div class="list-group-item px-0 py-2 bg-transparent">
                                <div class="fw-bold text-dark">{{ $review->client_name }} ({{ $review->company_name ?? 'Surat' }})</div>
                                <div class="text-muted text-truncate">{{ $review->review_text }}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Truthful Empty State -->
                    <div class="text-center py-4 px-2 bg-light rounded-3">
                        <i class="bi bi-chat-quote text-muted fs-3 mb-2 d-block"></i>
                        <div class="fw-semibold text-dark small mb-1">No published merchant reviews yet</div>
                        <p class="text-muted" style="font-size: 12px; margin: 0 auto; max-width: 280px;">
                            The review showcase is intentionally kept clean until genuine merchant testimonials are added through the Client Reviews module.
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Gallery Photos Status (Starts Empty) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-bold text-dark mb-0">
                        <i class="bi bi-images me-1 text-success"></i> Gallery Showcase Status
                    </h6>
                    <a href="{{ route('admin.gallery.index') }}" class="text-decoration-none small text-success fw-semibold">
                        Manage
                    </a>
                </div>

                @if($recentGallery->count() > 0)
                    <div class="row g-2">
                        @foreach($recentGallery as $photo)
                            <div class="col-6">
                                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title }}" class="img-fluid rounded-3 border">
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Truthful Empty State -->
                    <div class="text-center py-4 px-2 bg-light rounded-3">
                        <i class="bi bi-camera text-muted fs-3 mb-2 d-block"></i>
                        <div class="fw-semibold text-dark small mb-1">No gallery photos uploaded yet</div>
                        <p class="text-muted" style="font-size: 12px; margin: 0 auto; max-width: 280px;">
                            You can upload authentic saree embellishment and workshop photographs in the Gallery module.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
