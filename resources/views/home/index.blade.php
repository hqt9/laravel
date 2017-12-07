<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- <script type="text/javascript" src="{{ asset('/js/lib/jquery.js') }}"></script> -->

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/reset.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/home.css') }}">

    </head>
    <body>
        <div class="login-container">
            <form action="index" method="post" role="form" name="form1" id="form1" data-toggle="validator" novalidate="true">
                {{ csrf_field() }}
                <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> -->
                <div class="logo">
                    <img src="{{ asset('/images/logo.png') }}">
                </div>
                <h1>Sign in to Admin Panel</h1>
                <div class="error">
                    @if(!empty(session('error')))
                    {{session('error')}}
                    @endif
                </div>
                <div class="form-holder">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email: joe@example.com" required pattern="\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}" data-error="邮箱不能为空" />
                        <div class="msg-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password: 6-30 characters" required pattern="^[0-9a-zA-Z\s]{6,30}$" data-error="密码必须为6到30位" />
                        <div class="msg-errors"></div>
                    </div>
                    <div class="btn-set">
                        <a href="#" class="btn-login">Sign in</a>
                        <a href="{{ asset('register') }}" class="btn-register">Register</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-loading"></div>
    </body>
    <script type="text/javascript" src="{{ asset('/js/jquery/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript">
        $j = jQuery.noConflict();
        $j(function(){
            $j('.btn-login').on('click', function(){
                var $this = $j(this);
                var email = $j('#email').val();
                var emailReg = /[\w-\.]+@([\w-]+\.)+[a-z]{2,3}/;
                var password = $j('#password').val();
                var passwordReg = /^(\w){6,26}$/;
                var isError = false;
                var $form = $this.closest('form');
                var url = $form.attr('action');

                if(email == '') {
                    $j('#email').addClass('error');
                    $j('#email ~ .msg-errors').text('This is a required field.').addClass('active');
                    isError = true;
                } else {
                    if(!emailReg.test(email)) {
                        $j('#email').addClass('error');
                        $j('#email ~ .msg-errors').html('Please enter a valid email address:<br/>josh@some.com').addClass('active');
                        isError = true;
                    }
                }

                if(password == '') {
                    $j('#password').addClass('error');
                    $j('#password ~ .msg-errors').text('This is a required field.').addClass('active');
                    isError = true;
                } else {
                    if(!passwordReg.test(password)) {
                        $j('#password').addClass('error');
                        $j('#password ~ .msg-errors').html('Please enter a secure password:<br/>6-26 characters.').addClass('active');
                        isError = true;
                    }
                }

                if(!isError) {
                    //return true;
                    $j.ajxa({
                        url: url,
                        data: $form.serialize(),
                        beforeSend: function(){
                            $j('.login-loading').addClass('active');
                        }
                    }).done(function(response){
                        if(response.success !== false) {
                            window.location.href = '/home';
                        } else {
                            $j('.error').text('Error: Invalid login or password.' + response.message);
                        }
                        $j('.login-loading').removeClass('active');
                    });
                }

                return false;
                // $('#form1').submit();
            });

            $j('input').on('focus', function(){
                $j(this).removeClass('error');
                $j(this).closest('.form-group').find('.msg-errors').text('').removeClass('active');
            });
        });

    </script>
</html>

