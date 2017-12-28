<?php

namespace App\Http\Controllers\Home;

use Validator;
use Illuminate\Support\Facades\DB;
use App\Model\Home\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(Request $request)
    {
    	$_params = $request->all();
        $rules = [
            '_token' => [
                'required'
            ],
            'email' => [
                'required',
            ],
            'password' => [
                'required',
            ],
        ];

        $messages = [
            'required' => 'required',
        ];

        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            // return back()->with('error', getBaseApi());
            return response()->json([
                'success' => false,
                'message' => 'required',
                'data' => '',
            ]);
        }

        $result = curlPost(
                   getBaseApi().'/home', 
                   json_encode(['email' => $_params['email'], 'password' => $_params['password']])
        );

        if(isset($result['success']) && $result['success'] === true){
            return response()->json([
                'success' => true,
                'message' => '',
                'data' => array('name' => $result['name'], 'email' => $result['email'], 'token' => $_params['_token'])
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result,
            'data' => ''
        ]);

        // var_dump($result);

    	// $email = $_params['email'];
    	// $password = $_params['password'];

    	// $model = new Home;
    	// $res = $model::where('email', $email)->get();

    	// foreach ($res as $k) {
    	// 	// echo $k->email;
    	// }

    	// // dd(($k->email));die;
    	// if(isset($k->email) && $k->password == $password){
    	// 	return view('home/home');
    	// }

		// return back()->with('error', 'Email/Password is error! Please try again.');

    }


    public function register(Request $request)
    {
        return view('home/register');
    }

    public function registers(Request $request)
    {
    	$_params = $request->all();

        // $_token = isset($_params['_token']) ? $_POST['_token'] : '';
        // if ($_token == '') {
        //     return view('home/register');
        // }

        $rules = [
            // '_token' => [
            //     'required'
            // ],
            'email' => [
                'required',
            ],
            'password' => [
                'required',
            ],
        ];

        $messages = [
            'required' => 'required',
        ];

        $validator = Validator::make($_params, $rules, $messages);
        if ($validator->fails()) {
            // return back()->with('error', getBaseApi());
            return response()->json([
                'success' => false,
                'message' => 'required',
                'data' => '',
            ]);
        }


        $result = curlPost(
                   getBaseApi().'/register', 
                   json_encode(['name' => $_params['name'], 'email' => $_params['email'], 'password' => sha1(md5($_params['password'])), 'tel' => $_params['tel']])
                   // json_encode(['name' => $_params['name'], 'email' => $_params['email'], 'password' => $_params['password'], 'tel' => $_params['tel']])
        );

        if (isset($result['success']) && $result['success'] === true) {
            return response()->json([
                'success' => true,
                'message' => $result['info'],
                'data' => array('name' => $_params['name'], 'email' => $_params['email'], 'tel' => $_params['tel'])
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result,
            'data' => ''
        ]);

    	// $name = $_params['name'];
    	// $email = $_params['email'];
    	// $password = $_params['password'];
    	// $tel =$_params['tel'];

    	// $model = new Home;
    	// $res = $model::firstOrCreate([
    	// // $res = $model::create([
    	// 	'name' => $name,
    	// 	'email' => $email,
    	// 	'password' => $password,
    	// 	'tel' => $tel
    	// ]);

    
    }


    public function home()
    {
        $_result = curlPost(
                    getBaseApi().'/login/',
                    json_encode([ 'email' => session('email'), 'password' => session('password') ])
                );
        if($_result['success'] === true){
            return view('home/home');
            // return redirect()->action('HomeController@index');
        }
        // return view('admin.index', ['title' => 'Sign In']);
        return redirect('/');
    }
}
