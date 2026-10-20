<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAspirationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sender_name' => ['required', 'string', 'max:255'],
            'sender_email' => ['required', 'email', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'], // 5MB max
        ];
    }

    /**
     * Custom messages for validation
     */
    public function messages(): array
    {
        return [
            'sender_name.required' => 'Nama lengkap wajib diisi.',
            'sender_email.required' => 'Alamat email wajib diisi.',
            'sender_email.email' => 'Format email tidak valid.',
            'category.required' => 'Kategori aspirasi wajib dipilih.',
            'subject.required' => 'Perihal aspirasi wajib diisi.',
            'message.required' => 'Isi pesan aspirasi wajib diisi.',
            'message.min' => 'Pesan aspirasi minimal 10 karakter.',
            'attachment.max' => 'Ukuran berkas lampiran maksimal 5MB.',
            'attachment.mimes' => 'Format berkas lampiran harus berupa PDF, JPG, JPEG, atau PNG.',
        ];
    }
}
