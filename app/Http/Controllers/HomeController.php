<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $android_devices = \App\Analytic::where("platform", "=", "android")->count();
        $ios_devices = \App\Analytic::where("platform", "=", "ios")->count();
        $web_devices = \App\Analytic::where("platform", "=", "web")->count();
        $total_devices = \App\Analytic::all()->count();
        
        return view('home', [
            "analytics" => [
                "android" => $android_devices,
                "ios" => $ios_devices,
                "web" => $web_devices,
                "total" => $total_devices
            ]
        ]);
    }
}
