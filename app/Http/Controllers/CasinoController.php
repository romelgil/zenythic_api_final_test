<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CasinoController extends Controller
{
    public static function get_providers()
    {
        $url = "https://api.fiverscan.com";
        $post = [
            'method' => 'provider_list',
            'agent_code' => 'juv_ARS',
            'agent_token' => '1193eda490198f60454298f0a68d4605',
        ];

        $client = new Client();
        $response = $client->post($url, [
            'json' => $post,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'timeout' => 5,
        ]);

        $res = $response->getBody()->getContents();
        Log::info($res);
        return response()->json(json_decode($res, true));
    }

    public static function get_games($provider_code)
    {
        $url = "https://api.fiverscan.com";
        $post = [
            "method" => "game_list",
            "agent_code" => "juv_ARS",
            "agent_token" => "1193eda490198f60454298f0a68d4605",
            "provider_code" => $provider_code
        ];

        $client = new Client();
        $response = $client->post($url, [
            'json' => $post,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'timeout' => 5,
        ]);

        $res = $response->getBody()->getContents();
        Log::info($res);
        return response()->json(json_decode($res, true));
    }
}
