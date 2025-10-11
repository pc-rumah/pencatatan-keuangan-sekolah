<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Siswa;
use App\Models\Tagihan;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $agent = new Agent();

        $deviceinfo = [
            'device' => $agent->device(),
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
        ];

        $siswa = Siswa::count();
        $lunas = Tagihan::where('status', 'lunas')->count();
        $belumlunas = Tagihan::where('status', 'belum_lunas')->count();
        $total = $lunas + $belumlunas;

        $pendapatanPerBulan = DB::table('tagihans')
            ->join('jenis', 'tagihans.jenis_id', '=', 'jenis.id')
            ->select(
                DB::raw('MONTH(tagihans.created_at) as bulan'),
                DB::raw('SUM(jenis.nominal) as total_pendapatan')
            )
            ->where('tagihans.status', 'lunas')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total_pendapatan', 'bulan')
            ->toArray();

        // isi data kosong (bulan tanpa pendapatan = 0)
        $dataBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBulan[] = $pendapatanPerBulan[$i] ?? 0;
        }

        return view('dashboard', compact(
            'deviceinfo',
            'siswa',
            'lunas',
            'belumlunas',
            'total',
            'dataBulan'
        ));
    }
}
