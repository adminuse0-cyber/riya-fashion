@extends('layouts.admin')

@section('title', 'Business Information Management')
@section('page-header', 'Business Information Management')

@section('content')
<div class="container-fluid p-0">

    <!-- Page Header & Action Bar -->
    <form action="{{ route('admin.business.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
            <div>
                <h4 class="fw-bold text-dark mb-1 font-cinzel">
                    <i class="bi bi-building-gear text-primary me-2"></i> Business Information CMS
                </h4>
                <p class="text-muted small mb-0">
                    Update Riya Fashion's business profile, verified workshop address, contact numbers, hours, and branding without modifying code.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm px-3 py-2">
                    <i class="bi bi-x-circle me-1"></i> Cancel
                </a>
                <button type="submit" class="btn btn-gold btn-sm px-4 py-2">
                    <i class="bi bi-check2-circle me-1"></i> Save Changes
                </button>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column: Core Identity, Address, Contact, Hours -->
            <div class="col-lg-7">

                <!-- 1. GENERAL INFORMATION -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3 border-bottom pb-2">
                        <div class="bg-primary-subtle text-primary p-2 rounded-3"><i class="bi bi-info-circle-fill"></i></div>
                        <h5 class="fw-bold text-dark mb-0">1. General Business Information</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="business_name" class="form-label small fw-semibold">Business Name <span class="text-danger">*</span></label>
                            <input type="text" name="business_name" id="business_name" class="form-control @error('business_name') is-invalid @enderror" value="{{ old('business_name', $settings->business_name) }}" required>
                            @error('business_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="owner_name" class="form-label small fw-semibold">Owner / Proprietor Name <span class="text-danger">*</span></label>
                            <input type="text" name="owner_name" id="owner_name" class="form-control @error('owner_name') is-invalid @enderror" value="{{ old('owner_name', $settings->owner_name) }}" required>
                            @error('owner_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="experience_years" class="form-label small fw-semibold">Industry Experience <span class="text-danger">*</span></label>
                            <input type="text" name="experience_years" id="experience_years" class="form-control @error('experience_years') is-invalid @enderror" value="{{ old('experience_years', $settings->experience_years) }}" placeholder="e.g. 10+ Years" required>
                            @error('experience_years') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="target_market" class="form-label small fw-semibold">Primary Target Market <span class="text-danger">*</span></label>
                            <input type="text" name="target_market" id="target_market" class="form-control @error('target_market') is-invalid @enderror" value="{{ old('target_market', $settings->target_market) }}" placeholder="e.g. Surat, Gujarat" required>
                            <div class="form-text text-muted" style="font-size: 11px;">Primary client base: Textile merchants & traders in Surat.</div>
                            @error('target_market') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label for="tagline" class="form-label small fw-semibold">Business Tagline / Subtitle</label>
                            <input type="text" name="tagline" id="tagline" class="form-control @error('tagline') is-invalid @enderror" value="{{ old('tagline', $settings->tagline) }}">
                            @error('tagline') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- 2. CONFIRMED WORKSHOP & OFFICE ADDRESS -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3 border-bottom pb-2">
                        <div class="bg-danger-subtle text-danger p-2 rounded-3"><i class="bi bi-geo-alt-fill"></i></div>
                        <h5 class="fw-bold text-dark mb-0">2. Workshop & Office Location</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="address_line" class="form-label small fw-semibold">Street & Area Address <span class="text-danger">*</span></label>
                            <input type="text" name="address_line" id="address_line" class="form-control @error('address_line') is-invalid @enderror" value="{{ old('address_line', $settings->address_line) }}" required>
                            @error('address_line') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="city" class="form-label small fw-semibold">City <span class="text-danger">*</span></label>
                            <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', $settings->city) }}" required>
                            @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="form-label small fw-semibold">State <span class="text-danger">*</span></label>
                            <input type="text" name="state" id="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $settings->state) }}" required>
                            @error('state') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="pincode" class="form-label small fw-semibold">Postal Code (PIN) <span class="text-danger">*</span></label>
                            <input type="text" name="pincode" id="pincode" class="form-control @error('pincode') is-invalid @enderror" value="{{ old('pincode', $settings->pincode) }}" required>
                            @error('pincode') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="country" class="form-label small fw-semibold">Country <span class="text-danger">*</span></label>
                            <input type="text" name="country" id="country" class="form-control @error('country') is-invalid @enderror" value="{{ old('country', $settings->country) }}" required>
                            @error('country') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- 3. CONTACT INFORMATION -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3 border-bottom pb-2">
                        <div class="bg-success-subtle text-success p-2 rounded-3"><i class="bi bi-telephone-fill"></i></div>
                        <h5 class="fw-bold text-dark mb-0">3. Contact Information</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="phone" class="form-label small fw-semibold">Business Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $settings->phone) }}" placeholder="e.g. +91 98XXXXXXXX">
                            </div>
                            <div class="form-text" style="font-size: 11px;">Leave empty if not confirmed yet.</div>
                            @error('phone') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="whatsapp_number" class="form-label small fw-semibold">WhatsApp Number (For Direct Click-to-Chat CTA)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-whatsapp text-success"></i></span>
                                <input type="text" name="whatsapp_number" id="whatsapp_number" class="form-control @error('whatsapp_number') is-invalid @enderror" value="{{ old('whatsapp_number', $settings->whatsapp_number) }}" placeholder="e.g. 9198XXXXXXXX">
                            </div>
                            <div class="form-text" style="font-size: 11px;">Enter with country code (e.g. 9198XXXXXXXX) for WhatsApp CTA.</div>
                            @error('whatsapp_number') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label small fw-semibold">Official Business Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $settings->email) }}" placeholder="e.g. contact@riyafashion.com">
                            </div>
                            @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- 4. BUSINESS & WORKSHOP HOURS -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3 border-bottom pb-2">
                        <div class="bg-warning-subtle text-warning-emphasis p-2 rounded-3"><i class="bi bi-clock-fill"></i></div>
                        <h5 class="fw-bold text-dark mb-0">4. Business & Workshop Operating Hours</h5>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="hours_mon_sat" class="form-label small fw-semibold">Monday to Saturday Hours</label>
                            <input type="text" name="hours_mon_sat" id="hours_mon_sat" class="form-control @error('hours_mon_sat') is-invalid @enderror" value="{{ old('hours_mon_sat', $settings->hours_mon_sat) }}" placeholder="e.g. 9:00 AM - 8:00 PM">
                            @error('hours_mon_sat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="hours_sun" class="form-label small fw-semibold">Sunday Hours</label>
                            <input type="text" name="hours_sun" id="hours_sun" class="form-control @error('hours_sun') is-invalid @enderror" value="{{ old('hours_sun', $settings->hours_sun) }}" placeholder="e.g. Closed or By Appointment">
                            @error('hours_sun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label for="holiday_notes" class="form-label small fw-semibold">Festival / Holiday Notice (Optional)</label>
                            <input type="text" name="holiday_notes" id="holiday_notes" class="form-control @error('holiday_notes') is-invalid @enderror" value="{{ old('holiday_notes', $settings->holiday_notes) }}" placeholder="e.g. Workshop operates during major textile season peak rushes">
                            @error('holiday_notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- 5. ABOUT CONTENT -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3 border-bottom pb-2">
                        <div class="bg-secondary-subtle text-secondary p-2 rounded-3"><i class="bi bi-file-text-fill"></i></div>
                        <h5 class="fw-bold text-dark mb-0">5. About Content (Truthful Business Background)</h5>
                    </div>

                    <div class="mb-3">
                        <label for="about_short" class="form-label small fw-semibold">Short Summary (For Homepage Preview Cards)</label>
                        <textarea name="about_short" id="about_short" rows="3" class="form-control @error('about_short') is-invalid @enderror" placeholder="Brief summary of Riya Fashion's decade-long craftsmanship in Surat">{{ old('about_short', $settings->about_short) }}</textarea>
                        @error('about_short') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label for="about_full" class="form-label small fw-semibold">Full About Story (For Dedicated About Us Page)</label>
                        <textarea name="about_full" id="about_full" rows="6" class="form-control @error('about_full') is-invalid @enderror" placeholder="Detailed truthful background about 10+ years experience, dedicated workshop and office in Punagam, Surat, quality-focused processing, and requirement-based services">{{ old('about_full', $settings->about_full) }}</textarea>
                        <div class="form-text" style="font-size: 11px;">Preserve factual claims only (10+ years, dedicated office & workshop in Surat, requirement-based processing).</div>
                        @error('about_full') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

            </div>

            <!-- Right Column: Strengths, Google Maps, Socials, CTA, Images -->
            <div class="col-lg-5">

                <!-- 6. BUSINESS STRENGTHS & PROCESS NOTE -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3 border-bottom pb-2">
                        <div class="bg-warning-subtle text-warning-emphasis p-2 rounded-3"><i class="bi bi-stars"></i></div>
                        <h5 class="fw-bold text-dark mb-0">6. Business Strengths & Process</h5>
                    </div>

                    <div class="mb-3">
                        <label for="bulk_work_heading" class="form-label small fw-semibold">Bulk Work Strength Heading</label>
                        <input type="text" name="bulk_work_heading" id="bulk_work_heading" class="form-control @error('bulk_work_heading') is-invalid @enderror" value="{{ old('bulk_work_heading', $settings->bulk_work_heading) }}">
                        @error('bulk_work_heading') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="bulk_work_description" class="form-label small fw-semibold">Bulk & Time-Sensitive Work Description</label>
                        <textarea name="bulk_work_description" id="bulk_work_description" rows="3" class="form-control @error('bulk_work_description') is-invalid @enderror">{{ old('bulk_work_description', $settings->bulk_work_description) }}</textarea>
                        <div class="form-text" style="font-size: 11px;">Describe capacity truthfully without unrealistic guarantees.</div>
                        @error('bulk_work_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label for="process_note" class="form-label small fw-semibold">Requirement-Based Process Disclaimer Note</label>
                        <textarea name="process_note" id="process_note" rows="3" class="form-control @error('process_note') is-invalid @enderror">{{ old('process_note', $settings->process_note) }}</textarea>
                        <div class="form-text" style="font-size: 11px;">Emphasizes that services are customized and not every saree requires every service.</div>
                        @error('process_note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- 7. GOOGLE MAPS EMBED -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3 border-bottom pb-2">
                        <div class="bg-primary-subtle text-primary p-2 rounded-3"><i class="bi bi-map-fill"></i></div>
                        <h5 class="fw-bold text-dark mb-0">7. Google Maps Embed URL</h5>
                    </div>

                    <div class="mb-2">
                        <label for="google_map_embed_url" class="form-label small fw-semibold">Google Maps Embed URL</label>
                        <input type="text" name="google_map_embed_url" id="google_map_embed_url" class="form-control @error('google_map_embed_url') is-invalid @enderror" value="{{ old('google_map_embed_url', $settings->google_map_embed_url) }}" placeholder="https://www.google.com/maps/embed?...">
                        <div class="form-text" style="font-size: 11px;">Paste the `src` attribute from Google Maps Share &gt; Embed Map.</div>
                        @error('google_map_embed_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- 8. SOCIAL LINKS -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3 border-bottom pb-2">
                        <div class="bg-info-subtle text-info-emphasis p-2 rounded-3"><i class="bi bi-share-fill"></i></div>
                        <h5 class="fw-bold text-dark mb-0">8. Social Links & Profiles</h5>
                    </div>

                    <div class="mb-3">
                        <label for="whatsapp_link" class="form-label small fw-semibold">WhatsApp Direct Link URL</label>
                        <input type="url" name="whatsapp_link" id="whatsapp_link" class="form-control @error('whatsapp_link') is-invalid @enderror" value="{{ old('whatsapp_link', $settings->whatsapp_link) }}" placeholder="https://wa.me/91XXXXXXXXXX">
                        @error('whatsapp_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="instagram_url" class="form-label small fw-semibold">Instagram Profile URL</label>
                        <input type="url" name="instagram_url" id="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" value="{{ old('instagram_url', $settings->instagram_url) }}" placeholder="https://instagram.com/riyafashion...">
                        @error('instagram_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="facebook_url" class="form-label small fw-semibold">Facebook Page URL</label>
                        <input type="url" name="facebook_url" id="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" value="{{ old('facebook_url', $settings->facebook_url) }}" placeholder="https://facebook.com/riyafashion...">
                        @error('facebook_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="youtube_url" class="form-label small fw-semibold">YouTube Video / Channel URL (Optional)</label>
                        <input type="url" name="youtube_url" id="youtube_url" class="form-control @error('youtube_url') is-invalid @enderror" value="{{ old('youtube_url', $settings->youtube_url) }}" placeholder="https://youtube.com/...">
                        @error('youtube_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label for="google_business_url" class="form-label small fw-semibold">Google Business Profile URL (Optional)</label>
                        <input type="url" name="google_business_url" id="google_business_url" class="form-control @error('google_business_url') is-invalid @enderror" value="{{ old('google_business_url', $settings->google_business_url) }}" placeholder="https://g.page/...">
                        @error('google_business_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- 9. HOMEPAGE HERO CTA -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3 border-bottom pb-2">
                        <div class="bg-success-subtle text-success p-2 rounded-3"><i class="bi bi-megaphone-fill"></i></div>
                        <h5 class="fw-bold text-dark mb-0">9. Homepage Hero CTA Content</h5>
                    </div>

                    <div class="mb-3">
                        <label for="hero_heading" class="form-label small fw-semibold">Hero Main Heading</label>
                        <input type="text" name="hero_heading" id="hero_heading" class="form-control @error('hero_heading') is-invalid @enderror" value="{{ old('hero_heading', $settings->hero_heading) }}">
                        @error('hero_heading') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="hero_subheading" class="form-label small fw-semibold">Hero Subheading</label>
                        <textarea name="hero_subheading" id="hero_subheading" rows="3" class="form-control @error('hero_subheading') is-invalid @enderror">{{ old('hero_subheading', $settings->hero_subheading) }}</textarea>
                        @error('hero_subheading') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <label for="hero_cta_text" class="form-label small fw-semibold">Button Text</label>
                            <input type="text" name="hero_cta_text" id="hero_cta_text" class="form-control @error('hero_cta_text') is-invalid @enderror" value="{{ old('hero_cta_text', $settings->hero_cta_text) }}">
                        </div>
                        <div class="col-6">
                            <label for="hero_cta_link" class="form-label small fw-semibold">Button Link / Anchor</label>
                            <input type="text" name="hero_cta_link" id="hero_cta_link" class="form-control @error('hero_cta_link') is-invalid @enderror" value="{{ old('hero_cta_link', $settings->hero_cta_link) }}">
                        </div>
                    </div>
                </div>

                <!-- 10. BUSINESS BRANDING IMAGES (Max 2MB per image) -->
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <div class="d-flex align-items-center gap-2 mb-3 border-bottom pb-2">
                        <div class="bg-primary-subtle text-primary p-2 rounded-3"><i class="bi bi-image-fill"></i></div>
                        <h5 class="fw-bold text-dark mb-0">10. Business Branding Images</h5>
                    </div>
                    <div class="text-muted small mb-3">Allowed types: JPG, JPEG, PNG, WEBP (Max: 2MB per file)</div>

                    <!-- Business Logo -->
                    <div class="mb-4 pb-3 border-bottom">
                        <label for="logo" class="form-label small fw-bold">Business Logo</label>
                        @if($settings->logo_path)
                            <div class="d-flex align-items-center gap-3 mb-2 p-2 bg-light rounded-3">
                                <img src="{{ asset('storage/' . $settings->logo_path) }}" alt="Logo" class="img-thumbnail" style="max-height: 50px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remove_logo" value="1" id="remove_logo">
                                    <label class="form-check-label small text-danger" for="remove_logo">
                                        Remove current logo
                                    </label>
                                </div>
                            </div>
                        @endif
                        <input type="file" name="logo" id="logo" class="form-control form-control-sm @error('logo') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
                        @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Workshop Cover Image -->
                    <div class="mb-4 pb-3 border-bottom">
                        <label for="workshop_image" class="form-label small fw-bold">Workshop Cover Image</label>
                        @if($settings->workshop_image_path)
                            <div class="d-flex align-items-center gap-3 mb-2 p-2 bg-light rounded-3">
                                <img src="{{ asset('storage/' . $settings->workshop_image_path) }}" alt="Workshop" class="img-thumbnail" style="max-height: 60px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remove_workshop_image" value="1" id="remove_workshop_image">
                                    <label class="form-check-label small text-danger" for="remove_workshop_image">
                                        Remove current workshop image
                                    </label>
                                </div>
                            </div>
                        @endif
                        <input type="file" name="workshop_image" id="workshop_image" class="form-control form-control-sm @error('workshop_image') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
                        @error('workshop_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Office Image -->
                    <div class="mb-2">
                        <label for="office_image" class="form-label small fw-bold">Office Image</label>
                        @if($settings->office_image_path)
                            <div class="d-flex align-items-center gap-3 mb-2 p-2 bg-light rounded-3">
                                <img src="{{ asset('storage/' . $settings->office_image_path) }}" alt="Office" class="img-thumbnail" style="max-height: 60px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remove_office_image" value="1" id="remove_office_image">
                                    <label class="form-check-label small text-danger" for="remove_office_image">
                                        Remove current office image
                                    </label>
                                </div>
                            </div>
                        @endif
                        <input type="file" name="office_image" id="office_image" class="form-control form-control-sm @error('office_image') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
                        @error('office_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Sticky Action Card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-light">
                    <button type="submit" class="btn btn-gold w-100 py-3 fw-bold">
                        <i class="bi bi-save-fill me-1"></i> Save All Business Information
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-link text-muted small mt-2 text-decoration-none">
                        Return to Dashboard
                    </a>
                </div>

            </div>
        </div>

    </form>

</div>
@endsection
