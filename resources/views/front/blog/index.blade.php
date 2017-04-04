@extends('layouts.amaze')
@section('title', '-文章')


@section('content')
      
      <div class="am-u-lg-9">
      
        <div class="am-hide-sm my-bread-panel am-panel am-panel-default">
          <div class="am-panel-bd">
            <ol class="am-breadcrumb">
              <li><a href="#" class="am-icon-home">首页</a></li>
              <li><a href="{{url('blog')}}">文章</a></li>
              <li class="am-active">列表</li>
            </ol>
            <ol class="am-breadcrumb am-breadcrumb-slash">
              @foreach($cates as $acate)
              @if($acate->alias==$cate)
              <li class="active"><a href="{{url('blog',[$acate->alias])}}"><strong>{{$acate->name}}</strong></a></li>
              @else
              <li><a href="{{url('blog',[$acate->alias])}}">{{$acate->name}}</a></li>
              @endif
              @endforeach
            </ol>
          </div>
        </div>
        

        <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
        <div class="am-list-news-bd">
        <ul class="am-list">

        <?php foreach($blogs as $blog):?>
         <li class="am-g am-list-item-thumbed blog-item" onclick=location.href="{{url('blog',[$blog->id,$blog->title])}}">
          <div class="am-u-sm-5 am-u-md-4 am-u-lg-4 am-item-thumb">
            <a href="{{url('blog',[$blog->id,$blog->title])}}" class="">
              <img src="{{url($blog->thumb_img)}}" alt="{{$blog->title}}"/></a>
          </div>

          <div class=" am-u-sm-7 am-u-md-8 am-u-lg-8 am-list-main">
              <h2 class="am-list-item-hd blog-item-title">
                <a href="{{url('blog',[$blog->id,$blog->title])}}"><p class="am-text-truncate">{{$blog->title}}</p></a>
              </h2>
              
              <div class="am-list-item-text blog-item-text">{{$blog->abstract}}</div>
              
              <div class="am-list-item-text am-hide-sm-down blog-item-meta">
                
                  标签：
                  @foreach($blog->tags() as $atag)
                  <a href='{{url("blog?tag=$atag")}}' class="blog-item-tags">{{$atag}}</a>&nbsp
                  @endforeach
                  &nbsp&nbsp 阅读：<span class="blog-item-click">{{$blog->click}}</span>
              </div>

          </div>
         </li>
        <?php endforeach;?>

        </ul>
        </div>
        </div>
        @if($hasmore)
        <a id='more' class="am-text-center blog-more" onclick="" style="display:block">点击或下拉获取更多</a>
        @endif
      </div>

      <div class="am-u-lg-3 am-hide-md-down">

        <div class="am-panel am-panel-default list-side">
          <div class="am-panel-hd">
            <h3 class="am-panel-title">最热推荐</h3>
          </div>
          <ul class="am-list am-list-border">
          <?php foreach($hots as $hot):?>
          <li><a href="{{URL::action('Front\BlogController@show',['id'=>$hot->id])}}" class="am-text-truncate">{{$hot->title}}</a></li>
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

@section('js')
<script type="text/javascript">
var _page=2;
var _time = new Date();

var more = function(){
      var time = new Date();
      if (time-_time>1000){
          _time = time;
          $.ajax({
              type:'post',
              url:'{{url("/blog/pull")}}',
              data:{page:_page,cate:'{{$cate}}',tag:'{{$tag}}',_token:'{{csrf_token()}}'},
              dataType:'json',
          }).done(function(msg){
            if (msg.from==null) {
              // 此页没有数据
            }else{
              // 最后一页隐藏控制
              if (msg.current_page==msg.last_page) $('#more').hide();
              // 遍历添加数据
              $.each(msg.data,function(k,v){
                $('.blog-item:last').after(function(){
                  var nli = $(this).clone();
                  nli.find('img').attr('src','{{url("/")}}/'+v.thumb_img);
                  nli.find('p').html(v.title);
                  nli.find('.blog-item-text').html(v.abstract);
                  nli.find('.blog-item-tags').html(v.tags);
                  nli.find('.blog-item-click').html(v.click);
                  nli.find('a').attr('href','{{url("blog")}}/'+v.id+'/'+v.title)
                  nli.click(function(){
                    location.href=nli.find('a').attr('href');
                  })
                  return nli;
                });
              });
              _page=_page+1;


            }
            
            
              
          });
      }
}

$('#more').click(function(){
  more();
});

$(document).scroll(function() { 
  if ($(document).scrollTop()>=$(document).height()-$(window).height()) {   
      more();
  };
});



</script>

@endsection