<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Http\Requests\TagihanRequest;
use App\Http\Requests\TagihanUpdateRequest;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::with(['siswa:id,name', 'jenis:id,jenis_tagihan,nominal'])
            ->paginate(8);
        $jenis = Jenis::get(['id', 'jenis_tagihan']);
        $siswa = Siswa::get(['id', 'name']);
        return view('adminPanel.pages.tagihan.index', compact('tagihan', 'jenis', 'siswa'));
    }

    public function store(TagihanRequest $request)
    {
        try {
            $data = $request->validated();
            Tagihan::create($data);

            \Log::info("berhasil menambah data", ['data' => $data, 'created_by' => auth()->user()->name]);

            toast('berhasil menambah data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("gagal menambah data", ['error' => $e->getMessage()]);
            return redirect()->back();
        }
    }

    public function update(TagihanUpdateRequest $request, Tagihan $tagihan)
    {
        try {
            $data = $request->validated();
            $tagihan->update($data);

            \Log::info("berhasil mengupdate data", ['data' => $data, 'updated_by' => auth()->user()->name]);

            toast('berhasil mengupdate data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("gagal mengupdate data", ['error' => $e->getMessage()]);
            toast('gagal mengupdate data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function destroy(Tagihan $tagihan)
    {
        try {
            if ($tagihan->status === 'lunas') {
                $tagihan->delete();
                \Log::info("berhasil menghapus data", ['deleted_by' => auth()->user()->name]);
                toast('berhasil menghapus data', 'success')->timerProgressBar();
                return redirect()->back();
            } else {
                \Log::error("gagal menghapus data", ['deleted_by' => auth()->user()->name]);
                toast('tidak bisa menghapus tagihan belum lunas', 'error')->timerProgressBar();
                return redirect()->back();
            }
        } catch (\Exception $e) {
            \Log::error("gagal menghapus data", ['error' => $e->getMessage()]);
            toast('gagal menghapus data', ['error' => $e->getMessage()]);
            return redirect()->back();
        }
    }
}
