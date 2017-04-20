<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
use App\Http\Models\Tag;
use App\Http\Models\Cate;
use Illuminate\Http\Request;

class IndexApi extends Controller
{

	public function all(Request $request)
	{
		$callback = request('api');


		$blogs = Blog::select('id','abstract','tags','click','title','thumb_img')->latest()->take(request('count'))->get();

		foreach ($blogs as $blog) {
			$blog->tagsarr = Tag::tagsarr($blog->tags);
		}

		echo $callback.'('.json_encode($blogs).')';

		
	}


    public function hots(Request $request)
	{
		$callback = request('api');

		$hots = Blog::select('id','title','thumb_img')->orderBy('click','desc')->take(request('count'))->get();

		echo $callback.'('.json_encode($hots).')';

		
	}

	public function news(Request $request)
	{
		$callback = request('api');

		$news = Blog::select('id','title')->latest()->take(request('count'))->get();

		header('Content-Type: application/json');

		echo $callback.'('.json_encode($news).')';
		
	}

	public function tags(Request $request)
	{
		$callback = request('api');

		$tags = Tag::select('tagname')->inRandomOrder()->take(request('count'))->get();

		echo $callback.'('.json_encode($tags).')';

		
	}

	public function cates(Request $request)
	{
		$callback = request('api');

		$cates = Cate::all();

		echo $callback.'('.json_encode($cates).')';
	}


	
}