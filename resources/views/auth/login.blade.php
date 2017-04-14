@extends('layouts.amaze')

@section('content')
<div class="container">
    <div class="row">
        <div class="am-u-md-4 am-u-md-offset-4">
            
            <br>
                
            <form class="am-form am-form-horizontal" role="form" method="POST" action="{{ url('login/checkPhrase') }}">
                {{ csrf_field() }}

                <div class="am-input-group login-input {{ $errors->has('name') ? ' am-form-error' : '' }}">

                    <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>

                    <input type="text" name="name" class="am-form-field" placeholder="{{ $errors->has('name') ? $errors->first('name') : 'Username' }}" value="" required>
                    
                           
                </div>

                <div class="am-input-group login-input {{ $errors->has('password') ? ' am-form-error' : '' }}">

                    <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                    
                    <input type="password" class="am-form-field" placeholder="{{ $errors->has('password') ? $errors->first('password') : 'Password' }}" name="password" required>
          
                </div>


                <br>

                <div class="am-form-group{{ $errors->has('captcha') ? ' am-form-error' : '' }}">

                        <span onclick="javascript:re_captcha();">
                            <img class="am-img-responsive" src="{{ url('captcha/1') }}" style="width:100%" id="cap6699" />
                        </span>
                        <input id="captcha" type="text" class="am-form-field"  placeholder="{{ $errors->has('captcha') ? $errors->first('captcha') : '' }} " name="captcha" required>

                </div>
                    
                    <br>
                    <button type="submit" class="am-btn am-btn-success">登陆</button>
                            
                    <a type="button" href="{{url('register')}}" class="am-btn am-btn-primary">注册</a>

                    <a href="{{url('resetpass')}}" style="float:right;line-height:3.5em">  忘记密码？</a>


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
