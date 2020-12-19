<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Open Weather Map API Key
    |--------------------------------------------------------------------------
    / https://openweathermap.org/forecast5
    */
    'open_weather_key' => env('OPEN_WEATHER_API_KEY'),



    /*
    |--------------------------------------------------------------------------
    | Foursqure Search Venue API Key
    |--------------------------------------------------------------------------
    / https://developer.foursquare.com/docs/api/venues/search
    */
    'foursquare' => [
        'client_id' => env('FOURSQUARE_CLIENT_ID'),
        'client_secret' => env('FOURSQUARE_CLIENT_SECRET')
    ]

];
