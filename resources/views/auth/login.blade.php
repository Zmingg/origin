@extends('layouts.amaze')

@section('content')
<div class="container">
    <div class="row">
        <div class="am-u-md-4 am-u-md-offset-4">
            
                
            <form class="am-form am-form-horizontal" role="form" method="POST" action="{{ url('login/checkPhrase') }}">
                {{ csrf_field() }}

                <div class="am-input-group {{ $errors->has('name') ? ' has-error' : '' }}">

                    <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>
                    
                    <input type="text" name="name" class="am-form-field" placeholder="Username" value="{{ old('name') }}" required>

                    
                    
                </div>

                <div class="am-input-group {{ $errors->has('password') ? ' has-error' : '' }}">

                    <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>

                    <input type="password" class="am-form-field" placeholder="Password" name="password" required>
                    
                </div>

                @if ($errors->has('name'))
                    <span class="help-block" style="color:red">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif

                <br>

                <div class="am-form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">

                        <span onclick="javascript:re_captcha();">
                            <img class="am-img-responsive" src="{{ url('captcha/1') }}" style="width:100%" id="cap6699" />
                        </span>
                        <input id="captcha" type="text" class="form-control" name="captcha" required>
                        @if ($errors->has('captcha'))
                            <span class="help-block" style="color:red">
                                <strong>{{ $errors->first('captcha') }}</strong>
                            </span>
                        @endif

                </div>
                    
                    <br>
                    <button type="submit" class="am-btn am-btn-success">登陆</button>
                            
                    <button type="button" class="am-btn am-btn-primary">注册</button>


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
