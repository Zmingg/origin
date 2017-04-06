@extends('layouts.amaze')
@section('title', "-$blog->title")


@section('content')
<div class="am-container">

        <div class="am-hide-sm my-bread-panel am-panel am-panel-default">
          <div class="am-panel-bd">
            <ol class="am-breadcrumb">
              <li><i class="am-icon-home am-icon-xs">&nbsp  </i><a href="{{url('/')}}">首页</a></li>
              <li><a href="{{url('blog')}}">文章</a></li>
              <li><a href="{{url('blog')}}">{{$blog->cate->name}}</a></li>
              <li class="am-active">{{$blog->title}}</li>
            </ol>
          </div>
        </div>  


        <article class="am-article" >
          <div class="am-article-hd blog-detail-hd">
            <h1 class="am-article-title">{{$blog->title}}</h1>
            <p>
              <i class="am-icon-tags am-icon-xs"></i>&nbsp&nbsp
              @foreach($blog->tags() as $atag)
              <a href='{{url("blog?tag=$atag")}}' >{{$atag}}</a>&nbsp
              @endforeach
              &nbsp&nbsp&nbsp
              <i class="am-icon-user am-icon-xs"></i>&nbsp&nbsp{{$blog->user->nickname}}
            </p>
            <br>
          </div>

          <div class="am-article-bd">
            <!-- <p class="am-article-lead">{{$blog->abstract}}</p> -->
            {!!$blog->content!!}
          </div>
        </article>


  		
</div>



@endsection