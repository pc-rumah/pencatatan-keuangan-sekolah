<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Kelas;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with(['kelas:id,nama_kelas'])
            ->paginate(8);

        $kelas = Kelas::get(['id', 'nama_kelas']);
        return view('adminPanel.pages.siswa.index', compact('siswa', 'kelas'));
    }

    public function store(SiswaRequest $request)
    {
        try {
            $data = $request->validated();
            Siswa::create($data);

            \Log::info("Berhasil menyimpan data", ['data' => $data, 'created_by' => auth()->user()->name]);
            toast('Berhasil menambah data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("Gagal menyimpan data", ['error' => $e->getMessage(), 'created_by' => auth()->user()->name]);
            toast('Gagal menyimpan data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        try {
            $data = $request->validated();
            $siswa->update($data);

            \Log::info("Berhasil mengupdate data", ['data' => $data, 'created_by' => auth()->user()->name]);
            toast('Berhasil mengupdate data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("Gagal mengupdate data", ['error' => $e->getMessage()]);
            toast('Gagal mengupdate data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function destroy(Siswa $siswa)
    {
        $hapus = $siswa->delete();

        if ($hapus) {
            \Log::info("Berhasil menghapus data", ['deleted_by' => auth()->user()->name]);
            toast('Berhasil menghapus data', 'success')->timerProgressBar();
            return redirect()->back();
        } else {
            \Log::error("Gagal menghapus data");
            toast('Gagal menghapus data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }
}
