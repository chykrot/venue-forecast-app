<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    
    public function index(Request $request)
    {
        try {

            $response = Http::get('https://api.foursquare.com/v2/venues/search', [
                'near'          => "$request->location",
                'client_id'     => config('weather.foursquare.client_id'),
                'client_secret' => config('weather.foursquare.client_secret'),
                'v'             => '20190101',
                'locale'        => $request->lang,
                'limit'         => $request->limit
            ]);

            if ($response->failed() || $response->clientError()) {
                return response()->json(
                    json_decode($response->body()),
                    400
                );
            }

            return $this->formatResult($response->json());

        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }


    public function show(Request $request, $id)
    {      

        try {

            $response = Http::get("https://api.foursquare.com/v2/venues/$id", [
                'client_id'     => config('weather.foursquare.client_id'),
                'client_secret' => config('weather.foursquare.client_secret'),
                'v'             => '20190101',
                //'locale'        => $request->lang
            ]);

            if ($response->failed() || $response->clientError()) {
                return response()->json(
                    json_decode($response->body()),
                    400
                );
            }

            return response()->json([
                'venue' => $response->json()['response']['venue']
            ]);

        } catch (Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }


    private function formatResult($response)
    {
        return response()->json([
            'geocode' => $response['response']['geocode'],
            'venues' => $response['response']['venues']
        ]);
    }

    private function test()
    {
        $jsonString = file_get_contents(storage_path('app/show-location2.json'));

        return json_decode($jsonString, true);
    }
    
}
