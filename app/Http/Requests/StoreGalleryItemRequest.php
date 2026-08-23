<?php

namespace App\Http\Requests;

use App\Models\GalleryItem;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGalleryItemRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', Rule::in(array_merge(GalleryItem::CATEGORIES, ['Other']))],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description' => ['nullable', 'string', 'max:1000'],
            'display_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Please provide a descriptive title or caption for the photograph.',
            'category.required' => 'Please select a valid gallery category.',
            'category.in' => 'The selected category is invalid.',
            'image.required' => 'An image file is required.',
            'image.max' => 'The photograph must not exceed 2 MB.',
            'image.mimes' => 'The photograph must be a file of type: jpg, jpeg, png, webp.',
        ];
    }
}
