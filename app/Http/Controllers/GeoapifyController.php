<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressByCoorinateRequest;
use App\Http\Requests\SearchAddressRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class GeoapifyController extends Controller
{
    public function geoCoding(SearchAddressRequest $request) {
        # https://apidocs.geoapify.com/playground/geocoding/

        $response = Http::withUrlParameters([
            'search' => $request->search,
            'api_key' => config('app.geoapify_key')
        ])->get('https://api.geoapify.com/v1/geocode/search?text={search}&format=json&apiKey={api_key}');

        return $response;
    }

    public function autoCompleteAddress(SearchAddressRequest $request) {
        # https://apidocs.geoapify.com/playground/geocoding/#autocomplete

        $response = Http::withUrlParameters([
            'search' => $request->search,
            'api_key' => config('app.geoapify_key')
        ])->get('https://api.geoapify.com/v1/geocode/autocomplete?text={search}&format=json&apiKey={api_key}');

        return $response;

    }

    public function getAddressByCoordinates(AddressByCoorinateRequest $request) {
        # https://apidocs.geoapify.com/playground/geocoding/#reverse

        $response = Http::withUrlParameters([
            'lat' => $request->latitude,
            'lon' => $request->longitude,
            'api_key' => config('app.geoapify_key')
        ])->get('https://api.geoapify.com/v1/geocode/reverse?lat={lat}&lon={lon}&format=json&apiKey={api_key}');

        return $response;
    }

    public function defaultCities() {
        $cities = [
            ['city' => 'Tokyo','places' => []],
            ['city' => 'Yokohama','places' => []],
            ['city' => 'Kyoto','places' => []],
            ['city' => 'Osaka','places' => []],
            ['city' => 'Sapporo','places' => []],
            ['city' => 'Nagoya','places' => []]
        ];

        foreach($cities as $city_key => $city) {
            $response = Http::withUrlParameters([
                'search' => $city['city'],
                'type' => 'city',
                'filter' => 'countrycode:jp',
                'api_key' => config('app.geoapify_key')
            ])->get('https://api.geoapify.com/v1/geocode/search?text={search}&format=json&apiKey={api_key}');
    
            if (isset($response['results'])) {
                $cities[$city_key]['places'] = $response['results'];
            }
        }

        return $cities;
    }
}
