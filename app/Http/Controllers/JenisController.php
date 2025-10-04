<?php

namespace App\Http\Controllers;

use App\Http\Requests\JenisRequest;
use App\Models\Jenis;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis::paginate(8);
        return view('adminPanel.pages.jenis.index', compact('jenis'));
    }

    public function store(JenisRequest $request)
    {
        try {
            $data = $request->validated();
            Jenis::create($data);
            \Log::info("berhasil menambah data", [
                'data' => $data,
                'created_by' => auth()->user()->name
            ]);
            toast('Berhasil menambah data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("Gagal menambah data", [
                'created_by' => auth()->user()->name,
                'error' => $e->getMessage()
            ]);
            toast('gagal menambah data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function update(JenisRequest $request, Jenis $jenis)
    {
        try {
            $data = $request->validated();
            $jenis->update($data);
            \Log::info("berhasil mengupdate data", ['data' => $data, 'updated_by' => auth()->user()->name]);
            toast('berhasil mengupdate data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("Gagal mengupdate data", ['error' => $e->getMessage()]);
            return redirect()->back();
        }
    }

    public function destroy(Jenis $jenis)
    {
        try {
            $jenis->forceDelete();
            \Log::info("berhasil menghapus data", ['deleted_by' => auth()->user()->name]);
            toast('berhasil menghapus data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("gagal menghapus data", [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            toast('Gagal menghapus data: ' . $e->getMessage(), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }
}
