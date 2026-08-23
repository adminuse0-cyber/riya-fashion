<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if (empty($this->slug) && !empty($this->title)) {
            $this->merge([
                'slug' => Str::slug($this->title),
            ]);
        } elseif (!empty($this->slug)) {
            $this->merge([
                'slug' => Str::slug($this->slug),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:services,slug'],
            'short_description' => ['required', 'string', 'max:1000'],
            'full_description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'display_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The service title is required.',
            'slug.unique' => 'A service with this URL slug already exists. Please choose a unique slug.',
            'short_description.required' => 'The short description is required for service cards.',
            'image.max' => 'The service image must not exceed 2 MB.',
            'image.mimes' => 'The service image must be a file of type: jpg, jpeg, png, webp.',
        ];
    }
}
