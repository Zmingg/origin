@extends('layouts.amaze')
@section('title', '-濯而不染,清出于尘')


@section('content')


		<div class="am-g-fixed">

			<div class="am-u-lg-9 ">
				<div class="am-slider am-slider-c1" data-am-flexslider="
				{directionNav:false,playAfterPaused:1000,slideshowSpeed:4000,}
				"data-am-widget="slider" >
				  <ul class="am-slides">
				    <li>
				    	<img src="{{URL::asset('ass_ama/img/bing-1.jpg')}}" />
				    	<div class="am-slider-desc">Laravel —— 为WEB艺术家创造的PHP框架</div>
				    </li>
				    <li>
				    	<img src="{{URL::asset('ass_ama/img/bing-2.jpg')}}" />
				    	<div class="am-slider-desc">Amaze UI ~ 中国首个开源 HTML5 跨屏前端框架</div>
				    </li>
				    <li>
				    	<img src="{{URL::asset('ass_ama/img/bing-3.jpg')}}" />
				    	<div class="am-slider-desc">VUE.JS 2.0   渐进式JavaScript 框架</div>
				    </li>
				  </ul>
				</div>
				

				<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 hot-list">
					<?php foreach($hots as $hot):?>
				  	<li>
				  		<a href="{{URL::action('Front\BlogController@show',[$hot->id,$hot->title])}}">
							<img class="" src="{{url($hot->thumb_img)}}" />
				  		</a>
				  		
				  		<p class="am-text-truncate">
				  			{{$hot->title}}
				  		</p>
				  		
				  	</li>
					<?php endforeach;?>
				</ul>



			</div>
			<div class="am-u-lg-3 am-show-md-down my-blank"></div> <!-- 侧栏调低 -->
	  		<div class="am-u-lg-3 ">
	  			<div class="am-hide-md-only am-panel am-panel-default list-side">
					<div class="am-panel-hd">

						<h3 class="am-panel-title"><i class="am-icon-paw am-icon-xs"></i>&nbsp 今日天气</h3>
					</div>
					<main class="am-panel-bd panel-wheather">
						<div class="am-u-sm-6">
							<img class="wea_img"><br>
						</div>
						<div class="am-u-sm-6">
							<span class="wea_city"></span> 
							<span class="wea_s"></span><br>
							<span class="wea_t"> ℃</span><br>
							<span class="wea_w"> 级</span>
						</div>
					
					
					</main>
				</div>
	  			<div class="am-panel am-panel-default list-side">
					<div class="am-panel-hd">
						<h3 class="am-panel-title"><i class="am-icon-paw am-icon-xs"></i>&nbsp 最新推荐</h3>
					</div>	
				    <ul class="am-list am-list-border">
						<?php foreach($news as $new):?>
					  	<li><a href="{{URL::action('Front\BlogController@show',[$new->id,$new->title])}}" class="am-text-truncate">{{$new->title}}</a></li>
						<?php endforeach;?>
					</ul>
				</div>
				
				<!-- 标签云 require:$tags -->
				@component('front.tagcloud')
					@slot('tags')
				      {!!$tags!!}  
				    @endslot
				@endcomponent

	  		</div>

		</div>
	


        
    
@endsection

@section('js')

<script src="{{URL::asset('ass_ama/js/sinaweather.js')}}"></script>

@endsection
