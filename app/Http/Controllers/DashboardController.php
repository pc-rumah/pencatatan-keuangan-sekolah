<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $agent = new Agent();
        $device = $agent->device();
        $platform = $agent->platform();
        $browser = $agent->browser();

        return view('dashboard', compact('device', 'platform', 'browser'));
    }
}
