<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class API_CSRF
{
    public static $ip = '';
    public static $app_key;

    public static function get_csrf_token()
    {
        self::app_key();
        self::ip();
        $csrf_token = substr(password_hash('API_RELAY_' . md5(date('Ymd') . self::$ip . self::$app_key) . self::$app_key, PASSWORD_BCRYPT), 7);
        Log::info($csrf_token);
        return $csrf_token;
    }

    public static function app_key()
    {
        self::$app_key = 'base64:M2doaXRmM3dwajR6aTF3b3B6Yml5Nm51aDFvM2ZsYTU';
        if (
            substr(self::$app_key, 0, 7) === 'base64:'
        )
            self::$app_key = base64_decode(substr(self::$app_key, 7));
    }

    public static function ip()
    {
        self::$ip = "{$_SERVER['REMOTE_ADDR']}";
        if (self::$ip === '::1')
            self::$ip = '127.0.0.1';
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Generar el token CSRF y añadirlo a la solicitud
        $csrf_token = self::get_csrf_token();
        $request->headers->set('X-CSRF-TOKEN', $csrf_token);

        return $next($request);
    }
}
