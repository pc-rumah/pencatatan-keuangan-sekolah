<?php

namespace App\Http\Controllers;

use App\Http\Requests\TahunAjarRequest;
use App\Http\Requests\UpdateTaRequest;
use App\Models\TahunAjar;
use Illuminate\Http\Request;

class TahunAjarController extends Controller
{
    public function index()
    {
        $tahunAjar = TahunAjar::paginate(8);
        return view('adminPanel.pages.tahunAjar.index', compact('tahunAjar'));
    }

    public function store(TahunAjarRequest $request)
    {
        try {
            $data = $request->validated();
            TahunAjar::create($data);
            \Log::info("Berhasil Menambah data", ['data' => $data, 'created_by' => auth()->user()->name]);
            toast('Berhasil menambah data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("Gagal menambah data", ['data' => $data, 'created_by' => auth()->user()->name, 'error' => $e->getMessage()]);
            toast('Gagal menambah data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function update(UpdateTaRequest $request, TahunAjar $ta)
    {
        try {
            $data = $request->validated();
            $ta->update($data);
            \Log::info("Berhasil mengupdate data ta", ['data' => $data, 'created_by' => auth()->user()->name]);
            toast('Berhasil mengupdate data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("Gagal mengupdate data ta", ['created_by' => auth()->user()->name, 'error' => $e->getMessage()]);
            toast('Gagal mengupdate data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function destroy(TahunAjar $ta)
    {
        $hapus = $ta->delete();

        if ($hapus) {
            \Log::info("Berhasil menghapus data ta", ['created_by' => auth()->user()->name]);
            toast('Berhasil Menghapus data', 'success')->timerProgressBar();
            return redirect()->back();
        } else {
            toast('Gagal menghapus data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }
}
