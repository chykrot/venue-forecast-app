<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        try {

            $response = Http::get('https://api.openweathermap.org/data/2.5/forecast', [
                'q'     => "$request->location",
                'units' => 'metric',
                'appid' => config('weather.open_weather_key'),
                //'lang'  => 'ja'
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
        $list = collect($response['list'])
            ->chunk(8)
            ->map(function ($item) {
                return $item->first();
            });

        return response()->json([
            'city' => $response['city'],
            'list' => $list
        ]);
    }
}
