{{-- @extends('layouts.app') 
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h3 class="text-center mt-3">User Login</h3>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Admin Login') }}">
                        @csrf 
                        <div class="form-group">
                            <div class="col-md-8 offset-md-2">
                                <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="far fa-user"></i></div>
                                </div>
                                <input id="userId" type="text" class="form-control{{ $errors->has('userId') ? ' is-invalid' : '' }}" name="userId" value="{{ old('userId') }}"
                                    required autofocus> @if ($errors->has('userId'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('userId') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="col-md-8 offset-md-2">
                                <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                </div>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                    required> @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <title>IPT | Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    {{-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> --}}
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/login/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/login/vendor/animate/animate.css') }}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset('public/login/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/login/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/login/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ asset('public/login/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/login/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="{{ route('login') }}" method="post">
                    @csrf
                        <center>
                            <img class="mb-5 img-thumbnail" src="{{ asset('public/img/mbeya_logo.jpg') }}" width="250px" style="border-radius: 10px;" alt="">
                        </center>
                   {{--  <span class="login100-form-title p-b-43">
                        Login to continue
                    </span> --}}
                    
                    
                    <div class="wrap-input100 validate-input" data-validate = "Username is required ">
                        <input class="input100"  id="userId" type="text" name="userId">
                        <span class="focus-input100"></span>
                        <span class="label-input100"><i class="fa fa-user"></i></span>
                    </div>
                    
                    
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                        <span class="label-input100"><i class="fa fa-lock"></i></span>
                    </div>

                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="#" class="txt1">
                                Forgot Password?
                            </a>
                        </div>
                    </div>
            

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                    
                <!--    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                            or sign up using
                        </span>
                    </div> -->

                <!--    <div class="login100-form-social flex-c-m">
                        <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
                            <i class="fa fa-facebook-f" aria-hidden="true"></i>
                        </a>

                        <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                    </div> -->
                </form>

                <div class="login100-more" style="background-image: url('{{ asset('public/login/images/bg-01.jpg') }}')">
                    <div class="custom">
                        
            {{--             <h2>Welcome to IPT Management System</h2>
                <p class="lead mb-2">This system offer the following services</p>
                <span>Students</span>
                <ul class="list-unstyled ml-3">
                    <li class="li"><span class="fa fa-check mr-2 text-info"></span>Upload IPT-Documents</li>
                    <li class="li"><span class="fa fa-check mr-2 text-info"></span>Send Arrival Note</li>
                    <li class="li"><span class="fa fa-check mr-2 text-info"></span>Request Industrial Placement</li>
                </ul>

                <span>Supervisors</span>
                <ul class="list-unstyled ml-3">
                    <li class="li"><span class="fa fa-check mr-2 text-info"></span>View Assigned IPT-Students</li>
                    <li class="li"><span class="fa fa-check mr-2 text-info"></span>Assess Students</li>
                </ul>

                <span>Markers</span>
                <ul class="list-unstyled ml-3">
                    <li class="li"><span class="fa fa-check mr-2 text-info"></span>Mark students IPT-Documents</li>
                    <li class="li"><span class="fa fa-check mr-2 text-info"></span>View and Export Students IPT Results</li>
                </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    

    
    
<!--===============================================================================================-->
    <script src="{{ asset('public/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public/login/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public/login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('public/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public/login/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public/login/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('public/login/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public/login/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('public/login/js/main.js') }}"></script>

</body>
</html>