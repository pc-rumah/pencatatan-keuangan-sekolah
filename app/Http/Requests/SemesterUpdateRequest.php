<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SemesterUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
            'name' => 'required|unique:semesters,name|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ];
    }

    public function messages()
    {
        return [
            'tahun_ajar_id.required' => 'Tahun Ajar harus diisi',
            'tahun_ajar_id.exists' => 'Tahun Ajar yang dipilih tidak valid',
            'name.required' => 'Nama semester harus diisi',
            'name.unique' => 'Nama semester sudah digunakan',
            'start_date.required' => 'Tanggal mulai harus diisi',
            'end_date.required' => 'Tanggal selesai harus diisi',
            'end_date.after' => 'Tanggal selesai harus setelah tanggal mulai',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        \Log::warning("Validasi gagal saat menambah data semester", [
            'data' => $this->all(),
            'errors' => $validator->errors(),
            'user' => auth()->user()->name ?? 'guest'
        ]);

        toast('Data tidak valid: ' . implode(', ', $validator->errors()->all()), 'error')->timerProgressBar();

        parent::failedValidation($validator);
    }
}
