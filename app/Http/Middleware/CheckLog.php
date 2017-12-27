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
        if (isset($_params['aid']) ===true && isset($_params['_token']) === true && $_params['aid'] > 0 ) {
            $result = curlPost(
                getBaseApi().'home/',
                json_encode([ '_token' => $_params['_token'], 'aid' => $_params['aid'] ])
            );
            if ($result['success'] === ture) {
                return $next($request);
            } else ($result === false) {
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
