<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $business = Business::orderBy("id", "ASC");
        $municipality = \App\Municipality::onlySonora()->get();

        if($request->get("search") != "") {
            $business->where("name", "LIKE", "%".$request->get("search")."%");
            $business->orWhere("phone", "LIKE", "%".$request->get("search")."%");
        }
        if($request->get("municipality") != "" && $request->get("municipality") != "0")
            $business->where("municipality_id", "=", $request->get("municipality"));

        return view("modules.business", [
            "business" => $business->paginate(20),
            "municipalities" => $municipality
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipality = \App\Municipality::onlySonora()->get();
        return view('modules.business-create', [
            "municipalities" => $municipality
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"              => "required",
            // "address"           => "required",
            "phone"             => "min:10|max:10",
            "municipality_id"   => "required"
        ]);
        
        $business = $request->all();

        if ($request->hasFile('logo')) {
            $path = $request->logo->store('public');
            $business["logo"] = str_replace("public/", "", $path);
        }
               
        \App\Business::create($business);
        
        return redirect('business');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $business = \App\Business::find($id);

        $municipality = \App\Municipality::onlySonora()->get();
        return view('modules.business-edit', [
            "business" => $business,
            "municipalities" => $municipality
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name"              => "required",
            // "address"           => "required",
            "phone"             => "min:10|max:10",
            "municipality_id"   => "required"
        ]);
        
        $_business = $request->all();

        if ($request->hasFile('logo')) {
            $path = $request->logo->store('public');
            $_business["logo"] = str_replace("public/", "", $path);
        }

        $business = \App\Business::find($id);
        $business->fill($_business);
        $business->update();

        return redirect('business');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $business = \App\Business::find($id);
        if($business)
            $business->delete();

        return response()->json(["status" => "ok"]);
    }
}
