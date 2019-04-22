<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("analytics", function(Request $request) {
    $validator = \Validator::make($request->all(), [
        "uuid" => "required",
        "page" => "required",
        "platform" => "required"
    ]);

    if($validator->fails())
        return response()->json(["errors" => $validator->errors()], 400);

    return \App\Analytic::create($request->all());
});

Route::post("fcm/register", "Api\FCMController@create");
Route::post("fcm/sender", "Api\FCMController@send");

Route::post("benefits", "Api\BenefitsController@index");
Route::get("benefit/{id}", "Api\BenefitsController@show");
Route::get('news', function() {
    $crawler = new \App\Crawler;
    return $crawler->news();
});
Route::get('news/nacional', function() {
    $crawler = new \App\Crawler;
    return $crawler->newsNacional();
});
Route::get('reports', function() {
    $crawler = new \App\Crawler;
    return $crawler->reports();
});
Route::get('magazines', function() {
    $crawler = new \App\Crawler;
    return $crawler->magazines();
});
Route::get('youtube', function() {
    $crawler = new \App\Crawler;
    return $crawler->youtube();
});

Route::get('services', function() {
    return \App\ServiceType::all();
});
Route::get('municipalities', function() {
    return \App\Municipality::select(\DB::raw("DISTINCT municipios.id, municipio"))
        ->join("benefits", "municipios.id", "benefits.municipality_id")
        ->get();
});