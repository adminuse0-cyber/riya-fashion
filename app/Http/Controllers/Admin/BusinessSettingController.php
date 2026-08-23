<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBusinessSettingRequest;
use App\Models\BusinessSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BusinessSettingController extends Controller
{
    /**
     * Display the business information management CMS screen.
     */
    public function index(): View
    {
        $settings = BusinessSetting::getSettings();
        return view('admin.business.index', compact('settings'));
    }

    /**
     * Update the business information settings and handle business image uploads.
     */
    public function update(UpdateBusinessSettingRequest $request): RedirectResponse
    {
        $settings = BusinessSetting::getSettings();
        $validated = $request->validated();

        // 1. Handle Logo Upload / Removal
        if ($request->boolean('remove_logo')) {
            if ($settings->logo_path && Storage::disk('public')->exists($settings->logo_path)) {
                Storage::disk('public')->delete($settings->logo_path);
            }
            $validated['logo_path'] = null;
        } elseif ($request->hasFile('logo')) {
            if ($settings->logo_path && Storage::disk('public')->exists($settings->logo_path)) {
                Storage::disk('public')->delete($settings->logo_path);
            }
            $validated['logo_path'] = $request->file('logo')->store('business', 'public');
        }

        // 2. Handle Workshop Cover Image Upload / Removal
        if ($request->boolean('remove_workshop_image')) {
            if ($settings->workshop_image_path && Storage::disk('public')->exists($settings->workshop_image_path)) {
                Storage::disk('public')->delete($settings->workshop_image_path);
            }
            $validated['workshop_image_path'] = null;
        } elseif ($request->hasFile('workshop_image')) {
            if ($settings->workshop_image_path && Storage::disk('public')->exists($settings->workshop_image_path)) {
                Storage::disk('public')->delete($settings->workshop_image_path);
            }
            $validated['workshop_image_path'] = $request->file('workshop_image')->store('business', 'public');
        }

        // 3. Handle Office Image Upload / Removal
        if ($request->boolean('remove_office_image')) {
            if ($settings->office_image_path && Storage::disk('public')->exists($settings->office_image_path)) {
                Storage::disk('public')->delete($settings->office_image_path);
            }
            $validated['office_image_path'] = null;
        } elseif ($request->hasFile('office_image')) {
            if ($settings->office_image_path && Storage::disk('public')->exists($settings->office_image_path)) {
                Storage::disk('public')->delete($settings->office_image_path);
            }
            $validated['office_image_path'] = $request->file('office_image')->store('business', 'public');
        }

        // 4. Update the settings record
        $settings->update($validated);

        return redirect()->route('admin.business.index')
            ->with('success', 'Business Information updated successfully.');
    }
}
