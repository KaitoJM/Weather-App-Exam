<?php

use App\Http\Controllers\OpenWeatherController;
use App\Http\Controllers\GeoapifyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('get-forcast', [OpenWeatherController::class, 'getFiveDayThreeHourForcast']);
Route::post('get-weather', [OpenWeatherController::class, 'currentWeather']);
Route::post('get-geo-coding', [OpenWeatherController::class, 'geoCoding']);

Route::post('geo-coding', [GeoapifyController::class, 'geoCoding']);
Route::post('search-address', [GeoapifyController::class, 'autoCompleteAddress']);
Route::post('get-address-by-coordinates', [GeoapifyController::class, 'getAddressByCoordinates']);
