<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SportsController extends Controller
{
    public function get_all()
    {
        $response = Http::get('https://api.the-odds-api.com/v4/sports/', [
            'apiKey' => '8d994e2641c99eb364bec630112e66f3'
        ]);

        return $response->json();
    }

    public function get_sport($sport_type)
    {
        $response = Http::get('https://api.the-odds-api.com/v4/sports/', [
            'apiKey' => '8d994e2641c99eb364bec630112e66f3'
        ]);

        $sports = collect($response->json());
        $only_sport = $sports->filter(function ($sport) use ($sport_type) {
            return strpos(strtolower($sport['group']), strtolower($sport_type)) !== false;
        });

        return $only_sport->values()->all();
    }
}
