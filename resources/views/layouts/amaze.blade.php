<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">
  <title>清尘居 @yield('title')</title>

  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

<link rel="icon" href="/favicon.ico" />

  <link rel="icon" type="image/png" href="/favicon.png">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="assets/i/app-icon72x72@2x.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="assets/i/app-icon72x72@2x.png">
  <meta name="msapplication-TileColor" content="#0e90d2">
  
@section('style')
    <link rel="stylesheet" href="{{URL::asset('ass_ama/css/amazeui.css')}}">
    <link rel="stylesheet" href="{{URL::asset('ass_ama/css/app.css')}}">
@show 
<style type="text/css">
@media only screen and (min-width:641px){
  body{font-size:1.4rem;}
}
</style>
</head>

<body>

<header class="am-topbar am-topbar-fixed-top">
<div class="am-container">
    <h1 class="am-topbar-brand">
        <a href="{{url('/')}}">清 尘 居</a>
    </h1>
    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm  am-show-sm-only " data-am-offcanvas="{target: '#doc-side', effect: 'push'}">
    <span class="am-icon-bars"></span>
    </button>
    <div class="am-topbar-right am-nav am-nav-pills am-topbar-nav am-hide-sm-only">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li name="index"><a href="{{url('/')}}">首页</a></li>
      <li name="blog"><a href="{{url('/blog')}}">文章</a></li>
      @if (Auth::guest())
      <li><a href="{{url('/login')}}">登陆</a></li>
      @else
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          个人信息 <span class="am-icon-caret-down"></span>
        </a>
      <ul class="am-dropdown-content">
        <li><a>{{ Auth::user()->name }}</a></li>
        <li>
          <a href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          退出登陆
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
          </form>
      </li>
      </ul>
      </li>
      @endif
      </ul>
    </div>

  
</div>
</header>
<!-- 侧边栏内容 -->
    <div id="doc-side" class="am-offcanvas">
        <div class="amz-sidebar am-offcanvas-bar am-offcanvas-bar-overlay am-offcanvas-bar-active">
            <div class="am-offcanvas-content">
            <ul class="am-nav my-nav-side">
                <li class="am-nav-header"><a href="{{url('/')}}">清 尘 居</a></li>
                <li>
                  <a href="{{url('blog')}}">所有文章<span class="am-nav-en">all blogs</span></a>
                </li>
                @foreach ($cates as $cate)
                <li>
                  <a href="{{url('/blog/'.$cate->alias)}}">{{$cate->name}}<span class="am-nav-en">{{$cate->alias}}</span></a>
                </li>
                @endforeach
                <li>
                  @if (Auth::guest())
                  <a href="{{url('/login')}}">登陆<span class="am-nav-en">Login</span></a>
                  @else
                  <a href="{{url('/login')}}">{{Auth::user()->name}}<span class="am-nav-en">登出</span></a>
                  @endif
                </li>
            
            </ul>
            </div>
        </div>
    </div>

<!--   <div class="am-container">
    <div class="am-fl my-logo">
      <p class="am-kai">清 尘 之 家</p>
    </div>
    <div class="am-fr my-nav">
    <ul class="am-nav am-nav-pills">
        <li name='index' class=""><a href="{{ url('/') }}">首 页</a></li>
        <li name='blog'><a href="{{ url('/blog') }}">文 章</a></li>
        <li class="am-dropdown" data-am-dropdown>
            <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                菜 单 <span class="am-icon-caret-down"></span>
            </a>
            <ul class="am-dropdown-content">
              @if (Auth::guest())
              <li><a href="{{ url('/login') }}">登陆</a></li>
              @else
                <li class="am-dropdown-header">用户信息</li>
                <li><a>{{ Auth::user()->name }}</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
              @endif
              </ul>
        </li>
    </ul>
    </div>
  </div> -->


<div class="am-g am-g-fixed"> 
  @yield('content')
</div>

<div class="am-container">
<br>

  <div class="copyright">
  <p>Copyright © 1999-2016, QC.TEC, All Rights Reserved</p>
  </div>
  <br>
</div>

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{URL::asset('ass_ama/js/jquery.min.js')}}"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="{{URL::asset('ass_ama/js/amazeui.min.js')}}"></script>
<script type="text/javascript">
    var ali = $('li[name={{$active_on}}]');
    ali.addClass('am-active');
</script>
@yield('js')
</body>
</html>