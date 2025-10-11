<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagihanUpdateRequest extends FormRequest
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
            'bukti_pembayaran' => 'nullable|file|mimes:png,jpg,pdf|max:4096',
            'metode_pembayaran' => 'nullable|in:tunai,transfer',
        ];
    }

    public function messages(): array
    {
        return [
            // Jenis Tagihan
            'jenis_id.required' => 'Jenis tagihan wajib diisi.',
            'jenis_id.integer'  => 'Jenis tagihan harus berupa angka.',
            'jenis_id.exists'   => 'Jenis tagihan yang dipilih tidak valid.',

            // Siswa
            'siswa_id.required' => 'Siswa wajib dipilih.',
            'siswa_id.integer'  => 'ID siswa harus berupa angka.',
            'siswa_id.exists'   => 'Siswa yang dipilih tidak valid.',

            // Bukti Pembayaran
            'bukti_pembayaran.file'     => 'Bukti pembayaran harus berupa file yang valid.',
            'bukti_pembayaran.mimes'    => 'Bukti pembayaran hanya boleh berupa file PNG, JPG, atau PDF.',
            'bukti_pembayaran.max'      => 'Ukuran file bukti pembayaran maksimal 4MB.',

            // Metode Pembayaran
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih.',
            'metode_pembayaran.in'       => 'Metode pembayaran hanya boleh "tunai" atau "transfer".',
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
