<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $orgId = $this->route('organization')?->id ?? null;

        return [
            'name' => ['required', 'string', 'max:255'],
            'leader_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'sk_number' => ['required', 'string', 'max:255'],
            'sk_file' => [$this->isMethod('post') ? 'nullable' : 'nullable', 'file', 'mimes:pdf', 'max:10240'],
            'period_start' => ['nullable', 'date'],
            'period_end' => ['nullable', 'date', 'after_or_equal:period_start'],
            'status' => ['required', 'in:pending,verified,expired'],
        ];
    }
}
