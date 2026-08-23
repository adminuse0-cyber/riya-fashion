<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactEnquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Public submission allowed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'merchant_name'      => ['required', 'string', 'max:255'],
            'company_name'       => ['nullable', 'string', 'max:255'],
            'phone'              => ['required', 'string', 'max:50'],
            'email'              => ['nullable', 'email', 'max:150'],
            'service_interested' => ['nullable', 'string', 'max:255'],
            'estimated_quantity' => ['nullable', 'string', 'max:100'],
            'message'            => ['required', 'string', 'max:3000'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'merchant_name.required' => 'Please enter your name or merchant contact name.',
            'phone.required'         => 'Please provide a valid phone or WhatsApp number so we can respond to your enquiry.',
            'email.email'            => 'Please provide a valid email address format.',
            'message.required'       => 'Please describe your saree work or processing requirements.',
        ];
    }
}
