@extends('layouts.amaze')
@section('title', '文章')


@section('content')

      <div class="am-u-lg-9">

        <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
        <div class="am-list-news-bd">
        <ul class="am-list">

        <?php foreach($blogs as $blog):?>
         <li class="am-g am-list-item-thumbed" onclick="window.location.href='{!!URL::action('Front\BlogController@show',['id'=>$blog->id,'title'=>$blog->title])!!}'">
          <div class="am-u-sm-5 am-u-md-4 am-u-lg-4 am-list-thumb">
            <a href="{{URL::action('Front\BlogController@show',['id'=>$blog->id])}}" class="">
              <img src="{{url($blog->thumb_img)}}" alt="{{$blog->title}}"/>
            </a>
          </div>

          <div class=" am-u-sm-7 am-u-md-8 am-u-lg-8 am-list-main">
              <h2 class="am-list-item-hd blog-list-title">
                <a href="{!!URL::action('Front\BlogController@show',['id'=>$blog->id,'title'=>$blog->title])!!}"><p class="am-text-truncate">{{$blog->title}}</p></a>
              </h2>
              
              <div class="am-list-item-text blog-text">{{$blog->abstract}}</div>
              
              <div class="am-list-item-text am-hide-sm-down blog-meta">
                <p>
                  标签：{{$blog->tags}}&nbsp&nbsp 阅读：{{$blog->click}}</p>
              </div>

          </div>
         </li>
        <?php endforeach;?>

        </ul>
        </div>
        </div>

      </div>

      <div class="am-u-lg-3 am-hide-md-down">

        <div class="am-panel am-panel-default list-side">
          <div class="am-panel-hd">
            <h3 class="am-panel-title">最新推荐</h3>
          </div>
          <ul class="am-list am-list-border">
          <?php foreach($blogs as $blog):?>
          <li><a href="{{URL::action('Front\BlogController@show',['id'=>$blog->id])}}" class="am-text-truncate">{{$blog->title}}</a></li>
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
 

@endsection

