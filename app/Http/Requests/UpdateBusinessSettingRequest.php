<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // General Information
            'business_name' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'owner_name' => ['required', 'string', 'max:255'],
            'experience_years' => ['required', 'string', 'max:50'],
            'target_market' => ['required', 'string', 'max:255'],

            // Address
            'address_line' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'pincode' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],

            // Contact
            'phone' => ['nullable', 'string', 'max:50'],
            'whatsapp_number' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'email', 'max:150'],

            // Business Hours
            'business_hours' => ['nullable', 'string', 'max:255'],
            'hours_mon_sat' => ['nullable', 'string', 'max:100'],
            'hours_sun' => ['nullable', 'string', 'max:100'],
            'holiday_notes' => ['nullable', 'string', 'max:255'],

            // About Content
            'about_short' => ['nullable', 'string', 'max:1000'],
            'about_full' => ['nullable', 'string'],

            // Business Strengths & Process Note
            'bulk_work_heading' => ['nullable', 'string', 'max:255'],
            'bulk_work_description' => ['nullable', 'string'],
            'process_note' => ['nullable', 'string'],

            // Google Maps
            'google_map_embed_url' => ['nullable', 'string', 'max:1500'],

            // Social & Web Links
            'whatsapp_link' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'google_business_url' => ['nullable', 'url', 'max:255'],

            // Homepage CTA
            'hero_heading' => ['nullable', 'string', 'max:255'],
            'hero_subheading' => ['nullable', 'string'],
            'hero_cta_text' => ['nullable', 'string', 'max:100'],
            'hero_cta_link' => ['nullable', 'string', 'max:255'],

            // Business Images (Max 2MB, allowed: jpg, jpeg, png, webp)
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'workshop_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'office_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            // Image Removal flags
            'remove_logo' => ['nullable', 'boolean'],
            'remove_workshop_image' => ['nullable', 'boolean'],
            'remove_office_image' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Custom error messages for clear administrator feedback.
     */
    public function messages(): array
    {
        return [
            'email.email' => 'Please provide a valid email format (e.g. info@riyafashion.com).',
            'whatsapp_link.url' => 'The WhatsApp link must be a valid URL (e.g. https://wa.me/91XXXXXXXXXX).',
            'instagram_url.url' => 'The Instagram URL must be a valid link starting with http:// or https://.',
            'facebook_url.url' => 'The Facebook URL must be a valid link starting with http:// or https://.',
            'youtube_url.url' => 'The YouTube URL must be a valid link starting with http:// or https://.',
            'google_business_url.url' => 'The Google Business Profile URL must be a valid link starting with http:// or https://.',
            'logo.max' => 'The Business Logo must not exceed 2 MB in file size.',
            'logo.mimes' => 'The Business Logo must be an image of type: jpg, jpeg, png, or webp.',
            'workshop_image.max' => 'The Workshop Cover Image must not exceed 2 MB in file size.',
            'workshop_image.mimes' => 'The Workshop Cover Image must be an image of type: jpg, jpeg, png, or webp.',
            'office_image.max' => 'The Office Image must not exceed 2 MB in file size.',
            'office_image.mimes' => 'The Office Image must be an image of type: jpg, jpeg, png, or webp.',
        ];
    }
}
