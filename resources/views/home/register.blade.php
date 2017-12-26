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
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/home.css') }}">

    </head>
    <body>
        <div class="register-container">
            <form action="{{ asset('registers') }}" method="post" name="form2" id="form2" data-toggle="validator" novalidate="true">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                
                <h1>Register</h1>
                <div class="error"></div>
                <div class="form-holder">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="Name: 6-30 characters" required pattern="^[0-9a-zA-Z\s]{6,30}$" data-error="用户名不能为空" />
                        <div class="msg-errors"></div>
                    </div>
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
                    <div class="form-group">
                        <label for="password2">Confirm Password</label>
                        <input type="password" name="password2" id="password2" placeholder="Confirm Password" required pattern="^[0-9a-zA-Z\s]{6,30}$" data-error="密码必须为6到30位" />
                        <div class="msg-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="tel">Mobile Phone</label>
                        <input type="text" name="tel" id="tel" placeholder="Tel: 11 numbers" required/>
                        <div class="msg-errors"></div>
                    </div>
                    <div class="btn-set">
                        <a href="#" class="btn-login">Submit</a>
                        <a href="{{ asset('/') }}" class="btn-register">Back</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-loading"></div>
    </body>
    <script type="text/javascript">
        $(function(){
            $('.btn-login').on('click', function(){
                var $this = $(this);
                var name = $('#name').val();
                var email = $('#email').val();
                var emailReg = /[\w-\.]+@([\w-]+\.)+[a-z]{2,3}/;
                var password = $('#password').val();
                var password2 = $('#password2').val();
                var passwordReg = /^(\w){6,26}$/;
                var tel = $('#tel').val();
                var telReg = /^1[3578]\d{9}$/;
                var isError = false;
                var $form = $this.closest('form');
                var url = $form.attr('action');

                if (name == '') {
                    $('#name').addClass('error');
                    $('#name ~ .msg-errors').text('This is a required field.').addClass('active');
                    isError = true;
                } else {
                    if(!passwordReg.test(name)) {
                        $('#name').addClass('error');
                        $('#name ~ .msg-errors').html('Please enter a secure password:<br/>6-26 characters.').addClass('active');
                        isError = true;
                    }
                }

                if (tel == '') {
                    $('#tel').addClass('error');
                    $('#tel ~ .msg-errors').text('This is a required field.').addClass('active');
                    isError = true;
                } else {
                    if(!telReg.test(tel)) {
                        $('#tel').addClass('error');
                        $('#tel ~ .msg-errors').html('Tel format is error.').addClass('active');
                        isError = true;
                    }
                }

                if(email == '') {
                    $('#email').addClass('error');
                    $('#email ~ .msg-errors').text('This is a required field.').addClass('active');
                    isError = true;
                } else {
                    if(!emailReg.test(email)) {
                        $('#email').addClass('error');
                        $('#email ~ .msg-errors').html('Please enter a valid email address:<br/>josh@some.com').addClass('active');
                        isError = true;
                    }
                }

                if(password == '') {
                    $('#password').addClass('error');
                    $('#password ~ .msg-errors').text('This is a required field.').addClass('active');
                    isError = true;
                } else {
                    if(!passwordReg.test(password)) {
                        $('#password').addClass('error');
                        $('#password ~ .msg-errors').html('Please enter a secure password:<br/>6-26 characters.').addClass('active');
                        isError = true;
                    } else {
                        if (password != password2) {
                            $('#password2').addClass('error');
                            $('#password2 ~ .msg-errors').html('The second password is not match').addClass('active');
                            isError = true;
                        }
                    }
                }
                console.log(url);
                if(!isError) {
                    // $('#form2').submit();
                    $.ajax({
                        url: url,
                        data: $form.serialize(),
                        beforeSend: function(){
                            $('.login-loading').addClass('active');
                        }
                    }).done(function(response) {
                        if (response.success !== false) {
                            window.success = response.message;
                            window.location.href = '/';
                        } else {
                            $('div.error').text('Error: ' + response.message);
                        }
                        $('.login-loading').removeClass('active');
                    });
                }
                return false;
            });

            $('input').on('focus', function(){
                $(this).closest('#form2').find('div.error').text('');
                $(this).removeClass('error');
                $(this).closest('.form-group').find('.msg-errors').text('').removeClass('active');
            });

            $(document).keydown(function(e){
                if (e.keyCode == 13) {
                    $('.btn-login').click();
                }
            })

        });

    </script>
</html>
