@extends('layouts.amaze')
@section('title', '首页')


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
				  </ul>
				</div>
				

				<ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-4 hot-list">
					<?php foreach($hots as $hot):?>
				  	<li>
				  		<a href="{{URL::action('Front\BlogController@show',['id'=>$hot->id])}}">
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
						<h3 class="am-panel-title">今日天气</h3>
					</div>
					<main class="am-panel-bd panel-wheather">
						<div class="am-u-sm-6">
							<img src="{{$wea['img']}}"><br>
						</div>
						<div class="am-u-sm-6">
							{{$wea['city']}} {{$wea['status']}}<br>
							{{$wea['temp']}} ℃<br>
							空气质量 {{$wea['pollution']}}
						</div>
					
					
					</main>
				</div>
	  			<div class="am-panel am-panel-default list-side">
					<div class="am-panel-hd">
						<h3 class="am-panel-title">最新推荐</h3>
					</div>	
				    <ul class="am-list am-list-border">
						<?php foreach($news as $new):?>
					  	<li><a href="{{URL::action('Front\BlogController@show',['id'=>$new->id])}}" class="am-text-truncate">{{$new->title}}</a></li>
						<?php endforeach;?>
					</ul>
				</div>
				<div class="am-panel am-panel-default list-side">
		          <div class="am-panel-hd">
		            <h3 class="am-panel-title">标签云</h3>
		          </div>
		          <div class="am-list am-list-border tags-border">
		            {!!$tags!!}
		          </div> 
		        </div>
	  		</div>

		</div>
	


        
    
@endsection

@section('js')

@endsection
