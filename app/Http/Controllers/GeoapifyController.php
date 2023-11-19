<?php

namespace App\Http\Controllers;

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
}
