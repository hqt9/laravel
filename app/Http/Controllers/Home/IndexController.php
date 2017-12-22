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
                'data' => array(),
            ]);
        }

        $result = curlPost(
                   getBaseApi().'/home', 
                   json_encode(['a' => $_params['email'], 'qq' => '979137'])
        );

        if($result['success'] === true){
            return response()->json([
                'success' => true,
                'message' => '',
                'data' => array('name' => $result['name'], 'eamil' => $result['email'])
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => '',
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
    	$_params = $request->all();

    	$_token = isset($_params['_token']) ? $_POST['_token'] : '';

    	if ($_token == '') {
    		return view('home/register');
    	}

    	$name = $_params['name'];
    	$email = $_params['email'];
    	$password = $_params['password'];
    	$tel =$_params['tel'];

    	$model = new Home;
    	$res = $model::firstOrCreate([
    	// $res = $model::create([
    		'name' => $name,
    		'email' => $email,
    		'password' => $password,
    		'tel' => $tel
    	]);

    	// $res = $model::all();
    	// $res = DB::select('select * from logo_in');
    	// $res = DB::table('logo_in')->get();
    	echo date("Y-m-d H:i:s", time());
    	dd(($res));
    }


    public function testApi()
    {

    }
}
