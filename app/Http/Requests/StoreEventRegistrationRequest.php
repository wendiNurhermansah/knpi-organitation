<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'size:16', 'regex:/^[0-9]+$/'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'okp_origin' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus berjumlah 16 digit angka.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
            'email.required' => 'Email wajib diisi.',
            'phone.required' => 'Nomor WhatsApp / telepon wajib diisi.',
            'okp_origin.required' => 'Asal OKP atau instansi wajib diisi.',
        ];
    }
}
