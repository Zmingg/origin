<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>清尘 >> 登陆</title>

    <link href="{{URL::asset('ass_back/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('ass_back/Angular/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{URL::asset('ass_back/css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('ass_back/css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">QC</h1>

            </div>
            <p>
            </p>
            <h3>Welcome to QC.Blog</h3>
            <p>
            </p>
            <p>Login in. To see it in action.</p>
            <form class="m-t" role="form" method="POST" action="{{ url('admin/login') }}">
                {{ csrf_field() }}
                <div class="form-group form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="username" name="name" class="form-control" placeholder="Username" value="{{ old('name') }}" required="">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Password" name="password" required="">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot password?</small></a>
                
                
            </form>
            <p class="m-t"> <small>Blog on Bootstrap 3 &copy; QC.TEC 2017</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{URL::asset('ass_back/js/jquery-2.1.1.js')}}"></script>
    <script src="{{URL::asset('ass_back/js/bootstrap.min.js')}}"></script>

</body>

</html>
