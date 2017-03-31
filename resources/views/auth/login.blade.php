@extends('layouts.amaze')

@section('content')
<div class="container">
    <div class="row">
        <div class="am-u-md-4 am-u-md-offset-4">
            
                
                    <form class="am-form am-form-horizontal" role="form" method="POST" action="{{ url('login/checkPhrase') }}">
                        {{ csrf_field() }}

                        <div class="am-form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="doc-ipt-email-1">用户名：</label>

                            <input id="doc-ipt-email-1" type="text" class="" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码：</label>

                            <div class="">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="am-form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                            <div class="am-u-md-8">
                            <a onclick="javascript:re_captcha();">
                                <img src="{{ url('captcha/1') }}" id="cap6699" />
                            </a>
                            </div>
                            <div class="am-u-md-4">
                            <input id="captcha" type="text" class="form-control" name="captcha" required>
                            @if ($errors->has('captcha'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('captcha') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <!-- <a class="btn btn-link" href="">
                                    Forgot Your Password?
                                </a> -->
                            </div>
                        </div>
                    </form>
                
            
        </div>
    </div>
</div>
@endsection

@section('js')
<script>  
  function re_captcha() {
    url = "{{ url('captcha') }}";
        url = url+'/'+Math.random();
        document.getElementById('cap6699').src=url;
  }
</script>
@endsection
