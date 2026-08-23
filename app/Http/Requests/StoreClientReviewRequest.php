<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientReviewRequest extends FormRequest
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
            'client_name'  => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'location'     => ['required', 'string', 'max:255'],
            'review_text'  => ['required', 'string', 'max:2000'],
            'rating'       => ['nullable', 'integer', 'min:1', 'max:5'],
            'is_published' => ['nullable', 'boolean'],
            'display_order'=> ['required', 'integer', 'min:0'],
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'client_name.required'  => 'The merchant or client name is required.',
            'review_text.required'  => 'The review or testimonial text is required.',
            'location.required'     => 'Please enter the merchant location (e.g. Surat, Gujarat).',
            'rating.min'            => 'Rating must be between 1 and 5 stars.',
            'rating.max'            => 'Rating must be between 1 and 5 stars.',
        ];
    }
}
