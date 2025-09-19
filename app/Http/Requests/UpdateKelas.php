<?php

namespace App\Http\Requests;

use App\Models\Kelas;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKelas extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Kelas $kelas): array
    {
        return [
            'nama_kelas' => 'required|string|unique:kelas,nama_kelas,' . $kelas->id,
        ];
    }

    public function messages()
    {
        return [
            'nama_kelas.required' => 'Nama kelas harus diisi',
            'nama_kelas.unique' => 'Nama kelas sudah ada'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        \Log::warning("Validasi gagal saat update data kelas", [
            'data' => $this->all(),
            'errors' => $validator->errors(),
            'user' => auth()->user()->name ?? 'guest'
        ]);

        toast('Data tidak valid: ' . implode(', ', $validator->errors()->all()), 'error')->timerProgressBar();

        parent::failedValidation($validator);
    }
}
