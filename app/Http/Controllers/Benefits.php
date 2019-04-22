<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Benefit;
use App\Business;
use App\Municipality;
use App\ServiceType;

class Benefits extends Controller
{
    public function index() {
        $benefits = Benefit::paginate(20);
            
        return view("modules.benefit", ["benefits" => $benefits]);
    }

    public function create(Request $request) {
        $municipalities = Municipality::all();
        $service_types = ServiceType::all();
        $business = Business::all();

        return view("modules.benefit-new", [
           "municipalities" => $municipalities,
           "service_types"  => $service_types,
           "business"       => $business,
        ]);
    }

    public function edit(Request $request, $id) {
        $benefit = Benefit::find($id);

        if($benefit) {
            $municipalities = Municipality::onlySonora()->get();
            $service_types = ServiceType::all();
            $business = Business::all();
            

            return view("modules.benefit-edit", [
                "benefit"        => $benefit,
                "municipalities" => $municipalities,
                "service_types"  => $service_types,
                "business"       => $business,
            ]);
        }

        return response()->status(404);
    }

    public function save(Request $request) {
        $request->validate([
            "description"       => "required",
            "short_description" => "required",
            "municipality_id"   => "required",
            "service_type_id"   => "required",
            "business_id"       => "required"
        ]);

        $benefit = new \App\Benefit;
        $benefit->fill($request->all());
        $benefit->save();
        
        return redirect("benefits");
    }

    public function update(Request $request) {
        $request->validate([
            "id"                => "required",
            "description"       => "required",
            "short_description" => "required",
            "municipality_id"   => "required",
            "service_type_id"   => "required",
            "business_id"       => "required"
        ]);

        $benefit = \App\Benefit::find($request->input("id"));
        $benefit->fill($request->all());
        $benefit->update();
        
        return redirect("benefits");
    }

    public function delete(Request $request, $id) {
        $benefit = \App\Benefit::find($id);
        if($benefit)
            $benefit->delete();

        return redirect("benefits");
    }
}
