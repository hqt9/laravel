<?php 

if(!function_exists('getBaseApi')) {
	function getBaseApi() {
		return 'http://demo.api.com/laravel';
	}
}

/**
 * 获取当前控制器与方法
 *
 * @return array
 */
if(!function_exists('getCurrentAction')) {
    function getCurrentAction() {
        $action = \Route::current()->getActionName();
        list($class, $method) = explode('@', $action);
        $class = strtolower(str_replace('Controller', '', substr(strrchr($class,'\\'),1)));

        return ['controller' => $class, 'method' => $method];
    }
}

/**
 * 获取当前控制器名
 *
 * @return string
 */
if(!function_exists('getCurrentControllerName')) {
    function getCurrentControllerName() {
        return getCurrentAction()['controller'];
    }
}

/**
 * 获取当前方法名
 *
 * @return string
 */
if(!function_exists('getCurrentMethodName')) {
    function getCurrentMethodName() {
        return getCurrentAction()['method'];
    }
}

/**
 * php curl 发送post请求
 * 
 * @return data
 */
if(!function_exists('curlPost')) {
    function curlPost($url, $_params) {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$_params);

        curl_setopt($ch,CURLOPT_TIMEOUT,30000);
        // curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,0);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Expect:',
            'Content-Length: ' . strlen($_params))
        ); 
        $_result = curl_exec($ch);
        curl_close($ch);
        return json_decode($_result, true);
        // return $_result;
    }
}

/**
 * php curl 发送get请求
 *
 * @return data
 */
if(!function_exists('curlGet')) {
    function curlGet($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT,30000);
        // curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,0);
        
        $_result = curl_exec($ch);

        curl_close($ch);
        return json_decode($_result, true);
    }
}

/**
 * 为了返回数据setting里不暴露aid和token,在返回时删除
 * 原   'setting' => $_params
 * @return data
 */
if(!function_exists('unsetAid')) {
    function unsetAid($_params) {
        unset($_params['aid']);
        unset($_params['token']);
        return $_params;
    }
}

?>