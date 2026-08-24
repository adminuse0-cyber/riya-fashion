@extends('layouts.public')

@section('title', 'Contact Us & Workshop Location — ' . ($settings->business_name ?? 'Riya Fashion') . ' | Surat')
@section('meta_description', 'Contact Riya Fashion in Punagam, Surat for saree processing, lace patti, diamond work, hotfix, and roll polish enquiries. Visit our dedicated workshop.')

@section('content')

<!-- Header Banner -->
<section class="py-5" style="background: radial-gradient(circle at 10% 20%, #172554 0%, #0b1329 100%); color: #ffffff;">
    <div class="container py-2 py-md-3">
        <span class="section-tag section-tag-dark mb-2">Connect with Us</span>
        <h1 class="display-6 fw-bold text-white font-cinzel mb-2">Contact & Workshop Location</h1>
        <p class="text-light opacity-75 mb-0" style="max-width: 650px;">
            Visit our workshop in Punagam, Surat, connect via WhatsApp, or submit a bulk saree processing requirement.
        </p>
    </div>
</section>

<!-- Main Contact Section -->
<section class="py-5 bg-white">
    <div class="container py-3 py-md-4">
        <div class="row g-4 g-lg-5">
            <!-- Left Column: Business Details, Address, Hours, Map -->
            <div class="col-lg-5">
                <div class="card border-0 rounded-4 shadow-sm p-4 bg-light border mb-4">
                    <h2 class="h4 fw-bold text-dark font-cinzel mb-3 border-bottom pb-2">Workshop & Office</h2>

                    <ul class="list-unstyled mb-0 d-flex flex-column gap-3 small">
                        <!-- Address -->
                        <li class="d-flex align-items-start gap-3">
                            <div class="p-2 bg-primary-subtle text-primary rounded-3 flex-shrink-0"><i class="bi bi-geo-alt-fill fs-5" aria-hidden="true"></i></div>
                            <div>
                                <strong class="text-dark d-block">Workshop Address</strong>
                                <span class="text-muted">
                                    {{ $settings->address_line ?? 'B-115, Ishwernagar-2, Near Bombay Market to Sitanagar Road, Punagam' }},<br>
                                    {{ $settings->city ?? 'Surat' }}, {{ $settings->state ?? 'Gujarat' }} - {{ $settings->pincode ?? '395010' }}
                                </span>
                            </div>
                        </li>

                        <!-- Owner -->
                        <li class="d-flex align-items-start gap-3">
                            <div class="p-2 bg-warning-subtle text-warning-emphasis rounded-3 flex-shrink-0"><i class="bi bi-person-fill fs-5" aria-hidden="true"></i></div>
                            <div>
                                <strong class="text-dark d-block">Proprietor</strong>
                                <span class="text-muted">{{ $settings->owner_name ?? 'Pintu Kukadiya' }}</span>
                            </div>
                        </li>

                        <!-- Phone -->
                        @if(!empty($settings->phone))
                        <li class="d-flex align-items-start gap-3">
                            <div class="p-2 bg-success-subtle text-success rounded-3 flex-shrink-0"><i class="bi bi-telephone-fill fs-5" aria-hidden="true"></i></div>
                            <div>
                                <strong class="text-dark d-block">Phone Number</strong>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->phone) }}" class="text-dark fw-semibold text-decoration-none">
                                    {{ $settings->phone }}
                                </a>
                            </div>
                        </li>
                        @endif

                        <!-- WhatsApp -->
                        <li class="d-flex align-items-start gap-3">
                            <div class="p-2 bg-success text-white rounded-3 flex-shrink-0"><i class="bi bi-whatsapp fs-5" aria-hidden="true"></i></div>
                            <div>
                                <strong class="text-dark d-block">Direct WhatsApp</strong>
                                <a href="{{ $settings->whatsapp_url }}" target="_blank" rel="noopener noreferrer" class="text-success fw-bold text-decoration-none">
                                    Chat on WhatsApp (+91 9574731418) &raquo;
                                </a>
                            </div>
                        </li>

                        <!-- Email -->
                        @if(!empty($settings->email))
                        <li class="d-flex align-items-start gap-3">
                            <div class="p-2 bg-secondary-subtle text-secondary rounded-3 flex-shrink-0"><i class="bi bi-envelope-fill fs-5" aria-hidden="true"></i></div>
                            <div>
                                <strong class="text-dark d-block">Official Email</strong>
                                <a href="mailto:{{ $settings->email }}" class="text-dark text-decoration-none">
                                    {{ $settings->email }}
                                </a>
                            </div>
                        </li>
                        @endif

                        <!-- Hours -->
                        <li class="d-flex align-items-start gap-3">
                            <div class="p-2 bg-info-subtle text-info-emphasis rounded-3 flex-shrink-0"><i class="bi bi-clock-fill fs-5" aria-hidden="true"></i></div>
                            <div>
                                <strong class="text-dark d-block">Operating Hours</strong>
                                <span class="text-muted">
                                    Mon - Sat: {{ $settings->hours_mon_sat ?? '9:00 AM - 8:00 PM' }}<br>
                                    Sun: {{ $settings->hours_sun ?? 'Closed' }}
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Google Map Embed (If Configured) -->
                @if(!empty($settings->google_map_embed_url))
                    <div class="card border-0 rounded-4 overflow-hidden shadow-sm border mb-4">
                        <iframe src="{{ $settings->google_map_embed_url }}" width="100%" height="240" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Riya Fashion Workshop Google Map"></iframe>
                    </div>
                @endif
            </div>

            <!-- Right Column: B2B Merchant Enquiry Form -->
            <div class="col-lg-7">
                <div class="card border-0 rounded-4 shadow-sm p-4 p-md-5 bg-white border">
                    <span class="section-tag mb-2"><i class="bi bi-send-fill" aria-hidden="true"></i> Merchant Requirement Form</span>
                    <h2 class="h3 fw-bold text-dark font-cinzel mb-2">Send Your Requirement</h2>
                    <p class="text-muted small mb-4">
                        Fill out the form below with your saree lot details. Our team will review your specifications and contact you directly.
                    </p>

                    <form action="{{ route('contact.submit') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="merchant_name" class="form-label small fw-semibold">Your Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="merchant_name" 
                                       id="merchant_name" 
                                       class="form-control @error('merchant_name') is-invalid @enderror" 
                                       value="{{ old('merchant_name') }}" 
                                       placeholder="e.g. Ramesh Bhai" 
                                       required>
                                @error('merchant_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Company -->
                            <div class="col-md-6">
                                <label for="company_name" class="form-label small fw-semibold">Firm / Company Name (Optional)</label>
                                <input type="text" 
                                       name="company_name" 
                                       id="company_name" 
                                       class="form-control @error('company_name') is-invalid @enderror" 
                                       value="{{ old('company_name') }}" 
                                       placeholder="e.g. Shree Saree Traders">
                                @error('company_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <label for="phone" class="form-label small fw-semibold">Phone / WhatsApp Number <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="phone" 
                                       id="phone" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       value="{{ old('phone') }}" 
                                       placeholder="+91 98XXXXXXXX" 
                                       required>
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label small fw-semibold">Email Address (Optional)</label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" 
                                       placeholder="name@example.com">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Service Interested -->
                            <div class="col-md-6">
                                <label for="service_interested" class="form-label small fw-semibold">Service Interested</label>
                                <select name="service_interested" id="service_interested" class="form-select @error('service_interested') is-invalid @enderror">
                                    <option value="" selected>— Select Service (Optional) —</option>
                                    @php $preselected = request()->query('service'); @endphp
                                    @foreach($services as $srv)
                                        <option value="{{ $srv->title }}" {{ (old('service_interested') == $srv->title || $preselected == $srv->title) ? 'selected' : '' }}>
                                            {{ $srv->title }}
                                        </option>
                                    @endforeach
                                    <option value="Complete Saree Processing" {{ old('service_interested') == 'Complete Saree Processing' ? 'selected' : '' }}>Complete Saree Processing</option>
                                    <option value="Other Saree Work" {{ old('service_interested') == 'Other Saree Work' ? 'selected' : '' }}>Other Saree Work</option>
                                </select>
                                @error('service_interested') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Estimated Quantity -->
                            <div class="col-md-6">
                                <label for="estimated_quantity" class="form-label small fw-semibold">Estimated Saree Quantity</label>
                                <select name="estimated_quantity" id="estimated_quantity" class="form-select @error('estimated_quantity') is-invalid @enderror">
                                    <option value="" selected>— Select Lot Size (Optional) —</option>
                                    <option value="Sample Testing Lot" {{ old('estimated_quantity') == 'Sample Testing Lot' ? 'selected' : '' }}>Sample Testing Lot</option>
                                    <option value="50 - 200 Sarees" {{ old('estimated_quantity') == '50 - 200 Sarees' ? 'selected' : '' }}>50 - 200 Sarees</option>
                                    <option value="200 - 500 Sarees" {{ old('estimated_quantity') == '200 - 500 Sarees' ? 'selected' : '' }}>200 - 500 Sarees</option>
                                    <option value="500+ Sarees (Bulk)" {{ old('estimated_quantity') == '500+ Sarees (Bulk)' ? 'selected' : '' }}>500+ Sarees (Bulk Wholesale)</option>
                                </select>
                                @error('estimated_quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Message -->
                            <div class="col-12">
                                <label for="message" class="form-label small fw-semibold">Requirement Details <span class="text-danger">*</span></label>
                                <textarea name="message" 
                                          id="message" 
                                          rows="4" 
                                          class="form-control @error('message') is-invalid @enderror" 
                                          placeholder="Describe fabric type (e.g. Georgette, Silk, Chiffon), border width, stone placement, or urgent delivery deadlines..." 
                                          required>{{ old('message') }}</textarea>
                                @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Submit -->
                            <div class="col-12 pt-2">
                                <button type="submit" class="btn btn-gold w-100 py-3 fw-bold">
                                    <i class="bi bi-send-fill me-1" aria-hidden="true"></i> Submit Requirement Enquiry
                                </button>
                                <div class="text-center text-muted small mt-2">
                                    <i class="bi bi-lock-fill me-1" aria-hidden="true"></i> Your details are kept confidential and used solely to reply to your enquiry.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
