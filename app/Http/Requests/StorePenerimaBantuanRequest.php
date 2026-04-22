<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenerimaBantuanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'warga_id' => ['required', 'integer', 'exists:warga,id'],
            'program_id' => ['required', 'integer', 'exists:program_bantuan,id'],
            'tanggal_terima' => ['required', 'date'],
            'status_verifikasi' => ['required', 'in:pending,verified,rejected'],
        ];
    }
}
