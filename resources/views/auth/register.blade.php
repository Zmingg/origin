@extends('layouts.amaze')

@section('content')
<div class="container">
    <div class="row">
        <div class="am-u-md-4 am-u-md-offset-4">
        
        <br>

        <form class="am-form am-form-horizontal" role="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}


            <div class="am-input-group login-input {{ $errors->has('name') ? ' am-form-error' : '' }}">

                <span class="am-input-group-label"><i class="am-icon-user am-icon-fw"></i></span>

                <input type="text" class="am-form-field" placeholder="{{ $errors->has('name') ? $errors->first('name') : 'UserName' }}" name="name"  required autofocus>

            </div>

            <div class="am-input-group login-input {{ $errors->has('email') ? ' am-form-error' : '' }}">

                <span class="am-input-group-label"><i class="am-icon-at am-icon-fw"></i></span>

                <input type="text" class="am-form-field" placeholder="{{ $errors->has('email') ? $errors->first('email') : 'Email' }}" name="email" value="" required >
               
            </div>

            <div class="am-input-group login-input {{ $errors->has('password') ? ' am-form-error' : '' }}">

                <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>

                <input type="text" class="am-form-field" placeholder="{{ $errors->has('password') ? $errors->first('password') : 'Password' }}" name="password" required>
                
            </div>

            <div class="am-input-group login-input ">

                <span class="am-input-group-label"><i class="am-icon-lock am-icon-fw"></i></span>
                <input type="text" class="am-form-field" placeholder="Password Again" name="password_confirmation" required>
            
            </div>

            <br>
            <div class="am-input-group login-input " style="margin:auto">
                <button type="submit" class="am-btn am-btn-success">确认注册并登陆</button>
            </div>
        </form>
                
        </div>
    </div>
</div>
@endsection
