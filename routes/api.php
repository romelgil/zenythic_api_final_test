<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\CasinoController;

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

// Sports routes

Route::get('/sports', [SportsController::class, 'get_all']);
Route::get('/sports/soccer', function () {
    return app()->call('App\Http\Controllers\SportsController@get_sport', ['sport_type' => 'soccer']);
});
Route::get('/sports/basketball', function () {
    return app()->call([SportsController::class, 'get_sport'], ['sport_type' => 'basketball']);
});

Route::get('/sports/american-football', function () {
    return app()->call([SportsController::class, 'get_sport'], ['sport_type' => 'american football']);
});

Route::get('/sports/golf', function () {
    return app()->call([SportsController::class, 'get_sport'], ['sport_type' => 'golf']);
});

Route::get('/sports/ice-hockey', function () {
    return app()->call([SportsController::class, 'get_sport'], ['sport_type' => 'ice hockey']);
});

Route::get('/sports/aussie-football', function () {
    return app()->call([SportsController::class, 'get_sport'], ['sport_type' => 'aussie rules']);
});

Route::get('/sports/baseball', function () {
    return app()->call([SportsController::class, 'get_sport'], ['sport_type' => 'baseball']);
});

Route::get('/sports/boxing', function () {
    return app()->call([SportsController::class, 'get_sport'], ['sport_type' => 'boxing']);
});

Route::get('/sports/cricket', function () {
    return app()->call([SportsController::class, 'get_sport'], ['sport_type' => 'cricket']);
});

Route::get('/sports/mixed-martial-arts', function () {
    return app()->call([SportsController::class, 'get_sport'], ['sport_type' => 'mixed martial arts']);
});

Route::get('/sports/rugby-league', function () {
    return app()->call([SportsController::class, 'get_sport'], ['sport_type' => 'rugby league']);
});

// Casino routes

Route::group(['middleware' => 'api.csrf'], function () {
    Route::post('/casino', [CasinoController::class, 'casino_request']);
});