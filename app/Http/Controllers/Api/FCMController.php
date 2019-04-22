<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FCMController extends Controller
{
    public function form() {
        return view("fcm-sender");
    }

    public function send(Request $request) {
       
        $request->validate([
            "to" => "required",
            "title" => "required",
            "message" => "required"
        ]);
        
        $http = new \GuzzleHttp\Client();
        $options = [
            "json" => [
                "to" => $request->get("to"),
                "notification" => [
                    "title" => $request->get("title"),
                    "body" => $request->get("message"),
                    "sound" => "default",
                    "forceStart" => true
                ],
                "android" => [
                    "priority" => "high",
                    "senderID" => "931209002159",
                    "ttl" => "4500s",
                    "sound" => true,
                    "vibrate" => true,
                    "forceStart" => true
                ],
                
            ],
            "headers" => [
                "Content-type" => "application/json",
                "Authorization" => "key=AAAA2NBhvK8:APA91bGdCOdKVIeaajmfy3sIhCKqUHlStbIVPX7akiHht_YLfuYIligNAmClRtWX_t_5YSe7TJoCqFLbNg3z5N4tRzb619Qe5m8da-5ab8c9aXX2FibffAxVXLaxn8YV7ur44AYaf6PI"
            ]
        ];
        
        $response = $http->post('https://fcm.googleapis.com/fcm/send', $options);

        echo $response->getBody();
    }

    public function create(Request $request) {
        $validator = \Validator::make($request->all(), [
            "token" => "required",
            "uuid" => "required"
        ]);

        if($validator->fails())
            return response()->json(["errors" => $validator->errors()], 400);


        $uuid = \App\FCM_token::where("uuid", "=", $request->post("uuid"))->first();
        if($uuid) {
            $uuid->token = $request->post("token");
            $uuid->update();

            return $uuid;
        }

        $uuid = new \App\FCM_token;
        $uuid->uuid = $request->post("uuid");
        $uuid->token = $request->post("token");
        $uuid->save();

        return $uuid;

    }
}
