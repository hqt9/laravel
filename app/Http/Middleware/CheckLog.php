<?php

namespace App\Http\Middleware;

use Closure;

class CheckLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $_params = $request->all();
        if (isset($_params['email']) ===true && isset($_params['_token']) === true) {
            $result = curlPost(
                getBaseApi().'/home/',
                json_encode([ 'email' => $_params['email'], 'password' => $_params['password'] ])
            );
            if ($result['success'] === true) {
                return $next($request);
            } elseif ($result === false) {
                return response([
                    'success' => -1,
                    'message' => 'auth is login in another locale',
                    'data' => array()
                ]);
            }
        }
        return response([
            'success' => false,
            'message' => 'response over time',
            'data' => array()
        ]);
    }
}
