<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Http\Requests\TagihanRequest;
use Illuminate\Support\Facades\Storage;
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

    public function updateStatus(Tagihan $tagihan)
    {
        try {
            $updateStatus = $tagihan->status === 'belum_lunas' ? 'lunas' : 'belum_lunas';
            $tagihan->update(['status' => $updateStatus]);
            \Log::info("berhasil mengupdate status");
            toast('berhasil mengupdate status', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Throwable $e) {
            \Log::error("gagal mengupdate data", ['error' => $e->getMessage()]);
            toast('gagal mengupdate data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function update(TagihanUpdateRequest $request, Tagihan $tagihan)
    {
        try {
            $data = $request->validated();

            if ($request->hasFile('bukti_pembayaran')) {
                if ($tagihan->bukti_pembayaran && Storage::disk('public')->exists($tagihan->bukti_pembayaran)) {
                    Storage::disk('public')->delete($tagihan->bukti_pembayaran);
                }

                $gambarBaru = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
                $data['bukti_pembayaran'] = $gambarBaru;
                $data['status'] = 'lunas';
            }

            $tagihan->update($data);

            \Log::info("Berhasil mengupdate data", [
                'data' => $data,
                'updated_by' => auth()->user()->name
            ]);

            toast('Berhasil mengupdate data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Exception $e) {
            \Log::error("Gagal mengupdate data", ['error' => $e->getMessage()]);
            toast('Gagal mengupdate data', 'error')->timerProgressBar();
            return redirect()->back();
        }
    }

    public function destroy(Tagihan $tagihan)
    {
        try {
            if ($tagihan->status !== 'lunas') {
                \Log::warning("Gagal menghapus tagihan: status belum lunas", [
                    'tagihan_id' => $tagihan->id,
                    'status' => $tagihan->status,
                    'attempted_by' => auth()->user()->name
                ]);
                toast('Tidak bisa menghapus tagihan yang belum lunas', 'error')->timerProgressBar();
                return redirect()->back();
            }

            if ($tagihan->bukti_pembayaran && Storage::disk('public')->exists($tagihan->bukti_pembayaran)) {
                Storage::disk('public')->delete($tagihan->bukti_pembayaran);
            }

            \Log::info("Berhasil menghapus tagihan", [
                'tagihan_id' => $tagihan->id,
                'deleted_by' => auth()->user()->name,
                'data' => $tagihan->toArray()
            ]);

            $tagihan->delete();

            toast('Berhasil menghapus data', 'success')->timerProgressBar();
            return redirect()->back();
        } catch (\Throwable $e) {
            \Log::error("Gagal menghapus tagihan", [
                'tagihan_id' => $tagihan->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            toast('Gagal menghapus data: ' . $e->getMessage(), 'error')->timerProgressBar();
            return redirect()->back();
        }
    }
}
