<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use App\Http\Requests\UpdateKelas;
use App\Models\Kelas;
use Exception;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::paginate(8);
        return view('adminPanel.pages.kelas.index', compact('kelas'));
    }

    public function store(KelasRequest $request)
    {
        try {
            $data = $request->validated();
            Kelas::create($data);

            \Log::info("Berhasil menambah data kelas", ['data' => $data, 'created_by' => auth()->user()->name]);
            toast('Berhasil menambahkan data!', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("Gagal menambah data", ['data' => $request->all(), 'error' => $e->getMessage()]);
            toast('Gagal menambahkan data!', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function update(UpdateKelas $request, Kelas $kelas)
    {
        try {
            $validate = $request->validated();
            $kelas->update($validate);
            \Log::info("berhasil mengupdate data", ['created_by' => auth()->user()->name]);
            toast('Berhasil mengupdate data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("gagal mengupdate data", ['created_by' => auth()->user()->name, 'error' => $e->getMessage()]);
            toast('Gagal mengupdate data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function destroy(Kelas $kelas)
    {
        $hapus = $kelas->delete();

        if ($hapus) {
            \Log::info("berhasil menghapus data kelas", ['created_by' => auth()->user()->name]);
            toast('Berhasil menghapus data', 'success')->timerProgressBar();
            return redirect()->back();
        } else {
            toast('Gagal menghapus data', 'error');
            return redirect()->back();
        }
    }
}
