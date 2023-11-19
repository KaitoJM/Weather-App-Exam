<?php

use App\Http\Controllers\OpenWeatherController;
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
