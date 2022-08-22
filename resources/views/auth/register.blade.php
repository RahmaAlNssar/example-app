
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{__('dashboard.register')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('backend-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend-assets/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">


    <div class="login-box">

  
        <div class="login-logo">
        <img src="{{asset('backend-assets/dist/img/avatar5.png')}}" alt="" height="100" style="border-radius: 10px;">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
               

                <form action="{{ route('register') }}" method="post" class="submit-form">
                    @csrf
                   
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="{{__('dashboard.name')}}" name="name" value="{{old('name')}}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror 
                       
                    </div>
                  
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="{{__('dashboard.email')}}" name="email" value="{{old('email')}}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror 
                       
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder=" {{__('dashboard.password')}}" name="password" value="{{old('password')}}">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                         @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror 
                        
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder=" {{__('dashboard.password_confirmation')}}" name="password_confirmation" value="{{old('password_confirmation')}}" autocomplete="new-password">
                       
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                         @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror 
                        
                    </div>
                    <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat"> {{__('dashboard.register')}} </button>
                        </div>
                </form>

                <!-- /.social-auth-links -->

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('backend-assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend-assets/custom/js/script.js') }}"></script>

</body>

</html>