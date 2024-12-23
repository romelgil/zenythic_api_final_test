<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CasinoController extends Controller
{
    public static function casino_request()
    {
        $url = "https://casino-fortunato.com/api/proveedores";
        $post = [
            'method' => 'provider_list',
            'agent_code' => 'juv_ARS',
            'agent_token' => '1193eda490198f60454298f0a68d4605',
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post));

        ob_start();
        curl_exec($curl);
        $res = ob_get_clean();

        curl_close($curl);
        
        return response()->json(json_decode($res, true));
    }
}
