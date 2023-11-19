<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\FiveDayThreeHourRequest;
use App\Http\Requests\CurrentWeatherRequest;
use App\Http\Requests\GeoCodingRequest;

class OpenWeatherController extends Controller
{
    private $api_key = 'f99dc80c9a38c7d6017490f95df53b9d';

    public function getFiveDayThreeHourForcast(FiveDayThreeHourRequest $request) {
        # https://openweathermap.org/forecast5

        $response = Http::withUrlParameters([
                'lat' => $request->latitude,
                'lon' => $request->longitude,
                'appid' => $this->api_key
            ])->get('api.openweathermap.org/data/2.5/forecast?lat={lat}&lon={lon}&appid={appid}');

        return $response;
    }

    public function currentWeather(CurrentWeatherRequest $request) {
        # https://openweathermap.org/current
        
        $response = Http::withUrlParameters([
                'lat' => $request->latitude,
                'lon' => $request->longitude,
                'appid' => $this->api_key
            ])->get('https://api.openweathermap.org/data/2.5/weather?lat={lat}&lon={lon}&appid={appid}');

        return $response;
    }

    public function geoCoding(GeoCodingRequest $request) {
        # https://openweathermap.org/api/geocoding-api
        
        $response = Http::withUrlParameters([
            'city_name' => $request->city_name,
            'state_code' => $request->state_code,
            'country_code' => $request->country_code,
            'limit' => $request->has('limit') ? $request->limit : 5,
            'appid' => $this->api_key
        ])->get('http://api.openweathermap.org/geo/1.0/direct?q={city_name},{state_code},{country_code}&limit={limit}&appid={appid}');

        return $response;
    }
}
