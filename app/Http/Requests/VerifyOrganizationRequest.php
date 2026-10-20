<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:pending,verified,expired'],
            'sk_number' => ['nullable', 'string', 'max:255'],
            'sk_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'], // 10MB max PDF
            'period_start' => ['nullable', 'date'],
            'period_end' => ['nullable', 'date', 'after_or_equal:period_start'],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status verifikasi wajib dipilih.',
            'status.in' => 'Status verifikasi tidak valid.',
            'sk_file.mimes' => 'Dokumen SK Legalitas harus berupa file PDF.',
            'sk_file.max' => 'Ukuran file SK Legalitas maksimal 10MB.',
            'period_end.after_or_equal' => 'Tanggal akhir periode harus setelah atau sama dengan tanggal mulai.',
        ];
    }
}
