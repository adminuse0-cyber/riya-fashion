<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of all saree processing services.
     */
    public function index(): View
    {
        $services = Service::orderBy('display_order')->orderBy('id')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new saree processing service.
     */
    public function create(): View
    {
        $nextOrder = (Service::max('display_order') ?? 0) + 1;
        return view('admin.services.create', compact('nextOrder'));
    }

    /**
     * Store a newly created saree processing service in database.
     */
    public function store(StoreServiceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('services', 'public');
        }

        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('success', "Service '{$data['title']}' created successfully.");
    }

    /**
     * Show the form for editing the specified saree processing service.
     */
    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified saree processing service in database.
     */
    public function update(UpdateServiceRequest $request, Service $service): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', false);

        // Handle image removal
        if ($request->boolean('remove_image')) {
            if ($service->image_path && Storage::disk('public')->exists($service->image_path)) {
                Storage::disk('public')->delete($service->image_path);
            }
            $data['image_path'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            if ($service->image_path && Storage::disk('public')->exists($service->image_path)) {
                Storage::disk('public')->delete($service->image_path);
            }
            $data['image_path'] = $request->file('image')->store('services', 'public');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('success', "Service '{$service->title}' updated successfully.");
    }

    /**
     * Remove the specified saree processing service from database.
     */
    public function destroy(Service $service): RedirectResponse
    {
        $title = $service->title;

        // Safely delete associated image from disk
        if ($service->image_path && Storage::disk('public')->exists($service->image_path)) {
            Storage::disk('public')->delete($service->image_path);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', "Service '{$title}' deleted successfully.");
    }

    /**
     * Quick toggle publish / unpublish status for a service.
     */
    public function toggleStatus(Service $service): RedirectResponse
    {
        $service->is_active = !$service->is_active;
        $service->save();

        $statusText = $service->is_active ? 'published' : 'unpublished';

        return back()->with('success', "Service '{$service->title}' {$statusText} successfully.");
    }
}
