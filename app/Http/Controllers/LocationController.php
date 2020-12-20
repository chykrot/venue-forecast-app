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
                'limit'         => 5
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


    private function formatResult($response)
    {
        return response()->json([
            'geocode' => $response['response']['geocode'],
            'venues' => $response['response']['venues']
        ]);
    }
}
