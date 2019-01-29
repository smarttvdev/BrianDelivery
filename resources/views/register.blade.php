<!DOCTYPE html>
<html lang="en">
<head>
    <title>Move Company / Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--===============================================================================================-->
    {{--<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>--}}
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/login/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/login/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/login/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/login/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/login/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/login/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/login/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/login/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/login/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/login/main.css')}}">
    <!--===============================================================================================-->
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            transition: background-color 5000s ease-in-out 0s;
            color:white !important;
            -webkit-text-fill-color: white !important;
        }
        .register-link{
            color:#0f35c5;
        }
        .register-link:hover{
            color:white !important;

        }

    </style>
</head>
<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('public/images/bg-04.jpg');background-color: rgba(255,255,255,0.5);">
        <div class="wrap-login100">
            {{--<form class="login100-form validate-form" autocomplete="off" method="post" action="{{route('login')}}">--}}
            <form autocomplete="off" method="POST" action="{{ route('register') }}">
                @csrf
					<span class="login100-form-logo">
						<!--<i class="zmdi zmdi-landscape"></i>-->
                        <img src="{{asset('images/logo_home.png')}}" class="zmdi zmdi-landscape" style="width:120px; height:120px;border-radius:50%">
					</span>

                <span class="login100-form-title p-b-34 p-t-27">
						Register
					</span>
                @if ($errors->any())
                    <div class="alert alert-danger" style="background:none;border:none">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color:darkred">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif



                <div class="wrap-input100" data-validate = "Enter User Name">
                    <input class="input100" type="text" name="name" placeholder="User Name" required>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>


                <div class="wrap-input100 validate-input" data-validate = "Enter email">
                    <input class="input100" type="email" name="email" placeholder="Email" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    <span class="focus-input100" data-placeholder="&#xf207;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" name="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>
                </div>

                <div class="wrap-input100 validate-input">
                    <input class="input100" type="password" name="password_confirmation" placeholder="Password Confirmation" class="form-control" required>
                    <span class="focus-input100" data-placeholder="&#xf191;"></span>

                </div>



                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit">
                        Register
                    </button>
                </div>

                <div class="text-center" style="margin-top:30px">
                    <h6 class="txt1">Already have account?<span><a href="login" class="register-link" style="margin-left:10px;">Sign In</a> </span> </h6>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="{{asset('vendor/login/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/login/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/login/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('vendor/login/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/login/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/login/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('vendor/login/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('vendor/login/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('js/login/main.js')}}"></script>

</body>
</html>