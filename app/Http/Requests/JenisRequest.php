<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jenis_tagihan' => 'required|string|max:255',
            'nominal' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'jenis_tagihan.required' => 'Kolom jenis tagihan wajib diisi.',
            'jenis_tagihan.string'   => 'Kolom jenis tagihan harus berupa teks.',
            'jenis_tagihan.max'      => 'Kolom jenis tagihan maksimal :max karakter.',

            'nominal.required' => 'Nominal wajib diisi.',
            'nominal.numeric'   => 'Nominal harus berupa angka.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        \Log::warning("Validasi gagal saat menambah jenis tagihan", [
            'data' => $this->all(),
            'errors' => $validator->errors(),
            'user' => auth()->user()->name ?? 'guest'
        ]);

        toast('Data tidak valid: ' . implode(', ', $validator->errors()->all()), 'error')->timerProgressBar();

        parent::failedValidation($validator);
    }
}
