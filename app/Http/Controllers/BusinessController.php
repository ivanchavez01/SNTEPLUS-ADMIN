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
    public function index()
    {
        $business = Business::paginate(20);
        return view("modules.business", [
            "business" => $business
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
            // "phone"             => "required",
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
            "address"           => "required",
            "phone"             => "required",
            "municipality_id"   => "required"
        ]);
        
        $business = $request->all();

        if ($request->hasFile('logo')) {
            $path = $request->logo->store('public');
            $business["logo"] = $path;
        }

        $business = \App\Business::find($id);
        $business->fill($request->all());
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
