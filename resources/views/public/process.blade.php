@extends('layouts.public')

@section('title', 'Work Process & Workflow — ' . ($settings->business_name ?? 'Riya Fashion') . ' | Surat Saree Processing')
@section('meta_description', 'Learn about Riya Fashion\'s systematic 6-step saree processing workflow. Requirement-based customization and rigorous quality checking for Surat textile merchants.')

@section('content')

<!-- Header Banner -->
<section class="py-5" style="background: radial-gradient(circle at 10% 20%, #172554 0%, #0b1329 100%); color: #ffffff;">
    <div class="container py-2 py-md-3">
        <span class="section-tag section-tag-dark mb-2">Systematic Workflow</span>
        <h1 class="display-6 fw-bold text-white font-cinzel mb-2">Our Saree Processing Workflow</h1>
        <p class="text-light opacity-75 mb-0" style="max-width: 650px;">
            How Riya Fashion systematically handles your saree orders from fabric receipt to quality-inspected delivery.
        </p>
    </div>
</section>

<!-- Requirement Disclaimer Banner -->
<section class="py-4" style="background: #faf5ea; border-bottom: 1px solid #ebd9b0;">
    <div class="container">
        <div class="d-flex align-items-start gap-3">
            <div class="p-2 bg-warning bg-opacity-25 text-warning-emphasis rounded-3 fs-4 flex-shrink-0" style="width: 54px; height: 54px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-sliders" aria-hidden="true"></i>
            </div>
            <div>
                <h2 class="h5 fw-bold text-dark mb-1">Requirement-Based Process Customization</h2>
                <p class="text-muted small mb-0" style="line-height: 1.7;">
                    {{ $settings->process_note ?? 'Services are customized according to each saree design and merchant requirements. Not every saree requires every service.' }} 
                    A merchant may require only Lace Patti stitching, or exclusively Diamond Work, or purely Roll Polish and Dhaga Cutting. We tailor each workflow to your specific order.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Process Steps Section -->
<section class="py-5 bg-white">
    <div class="container py-3 py-md-4">
        <div class="row g-4">
            @forelse($processes as $process)
                <div class="col-lg-6">
                    <div class="card h-100 premium-card p-4 position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge bg-gold text-white fw-bold px-3 py-1 rounded-pill" style="background: #c59b27; font-size: 12px;">
                                Step {{ $process->step_number }}
                            </span>
                            <span class="text-muted small">Workflow Stage</span>
                        </div>

                        <h3 class="h4 fw-bold text-dark mb-2 font-cinzel">{{ $process->title }}</h3>
                        <p class="text-muted small mb-0" style="line-height: 1.8;">
                            {{ $process->description }}
                        </p>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    Work process steps are loaded from the system database.
                </div>
            @endforelse
        </div>

        <!-- Capability Highlight -->
        <div class="mt-5 p-4 rounded-4 bg-light border">
            <div class="row align-items-center g-3">
                <div class="col-lg-8">
                    <h3 class="h5 fw-bold text-dark mb-1 font-cinzel">Have Custom Saree Processing Specifications?</h3>
                    <p class="small text-muted mb-0">We can test merchant samples and provide tailored turnaround timelines for your upcoming catalog collections.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('contact') }}" class="btn btn-gold px-4 py-2">
                        Discuss Your Requirements
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
