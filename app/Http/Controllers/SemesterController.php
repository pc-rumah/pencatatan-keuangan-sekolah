<?php

namespace App\Http\Controllers;

use App\Http\Requests\SemesterRequest;
use App\Http\Requests\SemesterUpdateRequest;
use App\Models\Semester;
use App\Models\TahunAjar;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $semester = Semester::with(['tahunAjar:id,tahun_ajar'])
            ->latest()
            ->paginate(8);

        $tahunAjars = TahunAjar::orderByDesc('tahun_ajar')
            ->get(['id', 'tahun_ajar']);

        return view('adminPanel.pages.semester.index', [
            'semester' => $semester,
            'ta'        => $tahunAjars,
        ]);
    }

    public function store(SemesterRequest $request)
    {
        try {
            $data = $request->validated();
            Semester::create($data);
            \Log::info("Berhasil menambah data", ['data' => $data, 'created_by' => auth()->user()->name]);
            toast('Berhasil menambah data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("Gagal menambah data", ['error' => $e->getMessage()]);
            toast('Gagal Menambah data', 'error');
            return redirect()->back();
        }
    }

    public function update(SemesterUpdateRequest $request, Semester $semester)
    {
        try {
            $data = $request->validated();
            $semester->update($data);
            \Log::info("Berhasil Mengupdate data", ['data' => $data, 'created_by' => auth()->user()->name]);
            toast('Berhasil Mengupdate data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("Gagal Mengupdate data", ['error' => $e->getMessage()]);
            toast('Gagal Mengupdate data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function destroy(Semester $semester)
    {
        $hapus = $semester->delete();

        if ($hapus) {
            \Log::info("Berhasil menghapus data semester", ['deleted_by' => auth()->user()->name]);
            toast('Berhasil menghapus data', 'success')->timerProgressBar();
            return redirect()->back();
        } else {
            \Log::error("Gagal menghapus data", ['caused_by' => auth()->user()->name]);
            toast('Gagal menghapus data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function aktif(Semester $semester)
    {
        if ($semester->is_active == 0) {

            $semester->update(['is_active' => 1]);

            \Log::info("berhasil mengaktifkan");
            toast('berhasil mengaktifkan', 'success')->timerProgressBar();
            return redirect()->back();
        } else {
            toast('Semester sudah aktif', 'error')->timerProgressBar();
        }

        return redirect()->back();
    }

    public function nonaktif(Semester $semester)
    {
        if ($semester->is_active == 1) {
            $semester->update(['is_active' => 0]);

            \Log::info("berhasil menonaktifkan");
            toast('berhasil menonaktifkan', 'success')->timerProgressBar();
            return redirect()->back();
        } else {
            toast('Semester sudah nonaktif', 'error')->timerProgressBar();
        }
        return redirect()->back();
    }
}
