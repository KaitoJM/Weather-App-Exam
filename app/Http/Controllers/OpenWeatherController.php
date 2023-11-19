<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\FiveDayThreeHourRequest;
use App\Http\Requests\CurrentWeatherRequest;
use App\Http\Requests\GeoCodingRequest;

class OpenWeatherController extends Controller
{
    public function getFiveDayThreeHourForcast(FiveDayThreeHourRequest $request) {
        # https://openweathermap.org/forecast5

        $response = Http::withUrlParameters([
                'lat' => $request->latitude,
                'lon' => $request->longitude,
                'appid' => config('app.openweather_key')
            ])->get('api.openweathermap.org/data/2.5/forecast?lat={lat}&lon={lon}&units=metric&appid={appid}');

        return $response;
    }

    public function currentWeather(CurrentWeatherRequest $request) {
        # https://openweathermap.org/current
        
        $response = Http::withUrlParameters([
                'lat' => $request->latitude,
                'lon' => $request->longitude,
                'appid' => config('app.openweather_key')
            ])->get('https://api.openweathermap.org/data/2.5/weather?lat={lat}&lon={lon}&units=metric&appid={appid}');

        return $response;
    }

    public function geoCoding(GeoCodingRequest $request) {
        # https://openweathermap.org/api/geocoding-api

        $response = Http::withUrlParameters([
            'city_name' => $request->city_name,
            'state_code' => $request->state_code,
            'country_code' => $request->country_code,
            'limit' => $request->has('limit') ? $request->limit : 5,
            'appid' => config('app.openweather_key')
        ])->get('http://api.openweathermap.org/geo/1.0/direct?q={city_name},{state_code},{country_code}&limit={limit}&appid={appid}');

        return $response;
    }
}
