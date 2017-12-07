<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script type="text/javascript" src="{{ asset('/js/lib/jquery.js') }}"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/reset.css') }}">
        <!-- <link rel="stylesheet" type="text/css" href="{{ asset('/css/home.css') }}"> -->
        <!-- Styles -->
        <style>
            .login-container {max-width: 400px;margin: 0 auto;box-sizing: border-box; }
            .login-container h1 {padding: 20px;text-align: center;font-size: 24px;border-bottom: 1px solid #fdeae8; }
            .login-container .form-holder {padding: 20px;}
            .form-holder .form-group {padding-bottom: 30px;}
            .form-holder .form-group label {display: block;width: 100%; padding: 10px 0;}
            .form-holder .form-group input {padding: 8px;border: 1px solid #adadad;border-radius: 2px; width: 100%;font-size: 14px;}
            .form-holder .btn-set {padding: 10px 0;}
            .form-holder .btn-set .btn-login {background-color: #39967E;display: inline-block;width: 40%; text-align: center;padding: 15px 30px;font-size: 16px;color: #fff;border-radius: 5px;transition: background-color .25s;text-decoration: none;}
            .form-holder .btn-set .btn-register {padding-left: 50px;text-decoration: underline;color: #39967e;}
        </style>
    </head>
    <body>
        <div class="login-container">
            <form action="{{ asset('register') }}" method="post" name="form2" id="form2" data-toggle="validator" novalidate="true">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                
                <h1>Register</h1>
                <div class="form-holder">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="Name: 6-30 characters" required pattern="^[0-9a-zA-Z\s]{6,30}$" data-error="用户名不能为空" />
                        <div class="help-block with-errors">{{ isset($token) ? $token : 'x' }}</div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email: joe@example.com" required pattern="\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}" data-error="邮箱不能为空" />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password: 6-30 characters" required pattern="^[0-9a-zA-Z\s]{6,30}$" data-error="密码必须为6到30位" />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="password2">Confirm Password</label>
                        <input type="password" name="password2" id="password2" placeholder="Confirm Password" required pattern="^[0-9a-zA-Z\s]{6,30}$" data-error="密码必须为6到30位" />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="tel">Tel</label>
                        <input type="text" name="tel" id="tel" placeholder="1**" required pattern="^[0-9a-zA-Z\s]{6,30}$" data-error="密码必须为6到30位" />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="btn-set">
                        <a href="#" class="btn-login">Submit</a>
                        <a href="{{ asset('/') }}" class="btn-register">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
    <script type="text/javascript">
        $('.btn-login').on('click', function(){
            $('#form2').submit();
        });
    </script>
</html>
