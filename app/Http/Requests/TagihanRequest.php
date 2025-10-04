<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagihanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'jenis_id' => 'required|integer|exists:jenis,id',
            'siswa_id' => 'required|integer|exists:siswas,id',
        ];
    }

    public function messages()
    {
        return [
            'jenis_id.required' => 'jenis tagihan harus diisi',
            'jenis_id.integer' => 'jenis tagihan harus nomer',


            'siswa_id.required' => 'siswa harus di isi',
            'siswa_id.integer' => 'siswa harus nomer',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        \Log::warning("Validasi gagal saat menambah data siswa", [
            'data' => $this->all(),
            'errors' => $validator->errors(),
            'user' => auth()->user()->name ?? 'guest'
        ]);

        toast('Data tidak valid: ' . implode(', ', $validator->errors()->all()), 'error')->timerProgressBar();

        parent::failedValidation($validator);
    }
}
