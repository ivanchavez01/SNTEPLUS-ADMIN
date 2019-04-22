<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Benefit;

class BenefitsController extends Controller
{
    public function index(Request $request) {
        $query = Benefit::with(["municipality", "serviceType", "business"]);
        if($request->post("location") != "")
            $query->where("municipality_id", "=", $request->post("location"));
        if($request->post("service") != "" && $request->post("service") != "0")
            $query->where("service_type_id", "=", $request->post("service"));

        return $query
            // ->limit(20)
            ->get();
    }

    public function show(Request $request, $id) {
        return Benefit::with(["municipality", "serviceType", "business"])->find($id);
    }
}
