<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TahunAjarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tahun_ajar' => 'required|string|max:50|unique:tahun_ajars,tahun_ajar',
            'start_date' => 'required|date',
            'end_date' => 'required|after:start_date',
        ];
    }

    public function messages()
    {
        return [
            'tahun_ajar.required' => 'Tahun Ajar harus diisi',
            'tahun_ajar.unique' => 'Tahun Ajar sudah ada'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        \Log::warning("Validasi gagal saat menambah data tahun ajar", [
            'data' => $this->all(),
            'errors' => $validator->errors(),
            'user' => auth()->user()->name ?? 'guest'
        ]);

        toast('Data tidak valid: ' . implode(', ', $validator->errors()->all()), 'error')->timerProgressBar();

        parent::failedValidation($validator);
    }
}
