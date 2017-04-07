@extends('layouts.admin')
@section('title', 'Page Title')


@section('content')

        <h1>Hello, world!</h1>
        <h1>欢迎你使用后台!</h1>
        <hr>
        
        <div class="col-lg-4">                 
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h4><i class="fa fa-fire"></i>&nbsp&nbsp&nbsp最热文章</h4>
            </div>
            <div class="ibox-content no-padding">
                <ul class="list-group">
                	@php
                	$i=0;
					@endphp
                	@foreach($blogs as $blog)
                    <li class="" style="list-style-type:none;">
                    		<p class="col-lg-9" style="overflow:hidden;text-overflow:ellipsis;white-space: nowrap;">{{$i+=1}}&nbsp&nbsp&nbsp{{$blog->title}}</p>
                    		<p class="col-lg-2" style="float:right;text-align:right;">{{$blog->click}}</p>
                    </li> 
                    @endforeach
                    
                </ul>
            </div>
        </div>
      	</div>

@endsection