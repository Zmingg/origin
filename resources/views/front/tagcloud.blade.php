<div class="am-panel am-panel-default list-side">
  <div class="am-panel-hd">
    <h3 class="am-panel-title"><i class="am-icon-paw am-icon-xs"></i>&nbsp 标签云</h3>
  </div>
  <div class="am-list am-list-border tags-border">
	@php
		$fontStyle = array("1"=>"danger",
				"5"=>"info",
				"4"=>"warning",
				"3"=>"primary",
				"2"=>"success",
		);
	{{-- 	$fontSize = array("1"=>"",
				"5"=>"sm",
				"4"=>"default",
				"3"=>"lg",
				"2"=>"xl",
		); --}}
	@endphp
  	@foreach (json_decode($tags) as $tag)
	<a href='{{url("blog?tag=$tag->tagname")}}'>
		<span class="am-badge am-radius am-badge-{{$fontStyle[mt_rand(1,5)]}} am-text-sm">{{$tag->tagname}}</span>
	</a>
	@endforeach

  </div> 
</div>