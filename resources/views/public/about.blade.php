@extends('layouts.public')

@section('title', 'About Us — ' . ($settings->business_name ?? 'Riya Fashion') . ' | Saree Processing in Surat')
@section('meta_description', 'Learn about Riya Fashion, established by Pintu Kukadiya with 10+ years experience in Surat textile market. Dedicated B2B saree processing workshop in Punagam.')

@section('content')

<!-- Header Banner -->
<section class="py-5" style="background: radial-gradient(circle at 10% 20%, #172554 0%, #0b1329 100%); color: #ffffff;" aria-label="About Page Header">
    <div class="container py-2 py-md-3">
        <span class="section-tag section-tag-dark mb-2">Our Business Identity</span>
        <h1 class="display-6 fw-bold text-white font-cinzel mb-2">About {{ $settings->business_name ?? 'Riya Fashion' }}</h1>
        <p class="text-light opacity-75 mb-0" style="max-width: 650px;">
            A decade of authentic value-added saree craftsmanship, precision embellishments, and dependable B2B service for Surat textile merchants.
        </p>
    </div>
</section>

<!-- About Main Story -->
<section class="py-5 bg-white">
    <div class="container py-3 py-md-4">
        <div class="row g-4 g-lg-5 align-items-center">
            <div class="col-lg-6">
                <span class="section-tag"><i class="bi bi-clock-history" aria-hidden="true"></i> Established Craftsmanship</span>
                <h2 class="section-title fs-2 mb-3">10+ Years of Excellence in Surat's Textile Market</h2>

                <p class="text-muted" style="line-height: 1.8;">
                    {{ $settings->about_short ?? 'Riya Fashion is an established saree processing and value-addition business operating in Punagam, Surat. Owned and managed by Pintu Kukadiya, we specialize in transforming plain and designer saree lots with high-grade embellishments.' }}
                </p>

                <p class="text-muted" style="line-height: 1.8;">
                    {{ $settings->about_full ?? 'With over 10 years of hands-on experience in the heart of Surat’s vibrant textile ecosystem, Riya Fashion has built enduring business relationships with textile merchants, manufacturers, and traders. Operating from our own dedicated office and workshop near Bombay Market to Sitanagar Road, we combine skilled artisans with systematic processing workflows.' }}
                </p>

                <div class="p-3 bg-light rounded-4 border mb-4">
                    <div class="fw-bold text-dark mb-1"><i class="bi bi-person-badge-fill text-warning me-2" aria-hidden="true"></i> Proprietor & Leadership</div>
                    <div class="small text-muted">Managed and supervised directly by <strong>{{ $settings->owner_name ?? 'Pintu Kukadiya' }}</strong>, ensuring quality consistency across all bulk orders.</div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6 col-sm-6">
                        <div class="p-4 rounded-4 text-center border shadow-sm h-100" style="background: #faf8f5;">
                            <div class="fs-1 fw-bold text-warning font-cinzel">10+</div>
                            <div class="fw-bold text-dark small mb-1">Years Experience</div>
                            <div class="text-muted" style="font-size: 11px;">Surat Textile Market</div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6">
                        <div class="p-4 rounded-4 text-center border shadow-sm h-100" style="background: #faf8f5;">
                            <div class="fs-1 fw-bold text-primary font-cinzel">5+</div>
                            <div class="fw-bold text-dark small mb-1">Core Services</div>
                            <div class="text-muted" style="font-size: 11px;">Value-Added Processing</div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6">
                        <div class="p-4 rounded-4 text-center border shadow-sm h-100" style="background: #faf8f5;">
                            <div class="fs-1 fw-bold text-success font-cinzel">100%</div>
                            <div class="fw-bold text-dark small mb-1">Requirement-Based</div>
                            <div class="text-muted" style="font-size: 11px;">Tailored per Saree</div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6">
                        <div class="p-4 rounded-4 text-center border shadow-sm h-100" style="background: #faf8f5;">
                            <div class="fs-1 fw-bold text-info font-cinzel">B2B</div>
                            <div class="fw-bold text-dark small mb-1">Merchant Focus</div>
                            <div class="text-muted" style="font-size: 11px;">Wholesale Lots</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-4 rounded-4 bg-primary bg-opacity-10 border border-primary border-opacity-25">
                    <h3 class="h6 fw-bold text-primary mb-2"><i class="bi bi-geo-alt-fill me-1" aria-hidden="true"></i> Dedicated Surat Infrastructure</h3>
                    <p class="small text-muted mb-0">
                        Our workshop and office are located at <strong>{{ $settings->address_line ?? 'B-115, Ishwernagar-2, Near Bombay Market to Sitanagar Road, Punagam' }}, Surat - {{ $settings->pincode ?? '395010' }}</strong>. Merchants and traders are welcome to visit for material discussions and sample reviews.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values & Capabilities -->
<section class="py-5" style="background-color: #f8fafc;">
    <div class="container py-3 py-md-4">
        <div class="text-center mx-auto mb-5" style="max-width: 650px;">
            <span class="section-tag"><i class="bi bi-shield-check" aria-hidden="true"></i> Core Operating Values</span>
            <h2 class="section-title fs-2 mb-3">Built on Trust, Accuracy & Dependability</h2>
            <p class="text-muted">How Riya Fashion serves as a reliable extension of your saree manufacturing and trading operations.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 premium-card p-4">
                    <div class="service-icon-box mb-3"><i class="bi bi-sliders" aria-hidden="true"></i></div>
                    <h3 class="h5 fw-bold text-dark mb-2 font-cinzel">Customized per Saree</h3>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        {{ $settings->process_note ?? 'Services are customized according to each saree design and merchant requirements. Not every saree requires every service.' }}
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 premium-card p-4">
                    <div class="service-icon-box mb-3"><i class="bi bi-boxes" aria-hidden="true"></i></div>
                    <h3 class="h5 fw-bold text-dark mb-2 font-cinzel">Bulk Lot Readiness</h3>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        {{ $settings->bulk_work_description ?? 'Equipped with dedicated workshop capacity and experienced craftsmen to handle large volume saree orders and time-sensitive requirements with consistent quality.' }}
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100 premium-card p-4">
                    <div class="service-icon-box mb-3"><i class="bi bi-check2-all" aria-hidden="true"></i></div>
                    <h3 class="h5 fw-bold text-dark mb-2 font-cinzel">Rigorous Finishing</h3>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        Every saree undergoes thread trimming (dhaga cutting) and roll polishing to ensure spotless presentation before final dispatch back to the merchant.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
