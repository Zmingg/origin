@extends('layouts.amaze')
@section('title', '文章')


@section('content')
        <div class="am-container">

  		<h1>{{$blog->title}}</h1>
  		<p>
  			作者：{{$blog->user->nickname}}<br>
        标签：{{$blog->tags}}<br>
  		</p>
  		<hr>
  		{!!$blog->content!!}<br>
  		
      </div>



@endsection