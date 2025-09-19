<?php

namespace App\Http\Requests;

use App\Models\Siswa;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Siswa $siswa): array
    {
        return [
            'nik' => [
                'required',
                'string',
                'digits:16',
                Rule::unique('siswas', 'nik')->ignore($siswa),
            ],
            'nis' => [
                'required',
                'string',
                'max:30',
                Rule::unique('siswas', 'nis')->ignore($siswa),
            ],
            'name' => ['required', 'string', 'max:100'],
            'kelas_id' => ['required', 'integer', 'exists:kelas,id'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'alamat' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks/angka.',
            'nik.digits' => 'NIK harus tepat 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',

            'nis.required' => 'NIS wajib diisi.',
            'nis.string' => 'NIS harus berupa teks/angka.',
            'nis.max' => 'NIS maksimal 30 karakter.',
            'nis.unique' => 'NIS sudah terdaftar.',

            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 100 karakter.',

            'kelas_id.required' => 'Kelas wajib dipilih.',
            'kelas_id.integer' => 'Kelas tidak valid.',
            'kelas_id.exists' => 'Kelas yang dipilih tidak ditemukan.',

            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir tidak valid.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus L (Laki-laki) atau P (Perempuan).',

            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        \Log::warning("Validasi gagal saat mengupdate data siswa", [
            'data' => $this->all(),
            'errors' => $validator->errors(),
            'user' => auth()->user()->name ?? 'guest'
        ]);

        toast('Data tidak valid: ' . implode(', ', $validator->errors()->all()), 'error')->timerProgressBar();

        parent::failedValidation($validator);
    }
}
