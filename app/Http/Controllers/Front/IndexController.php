<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
use App\Http\Models\Tag;
use App\Libraries\Tool;

class IndexController extends Controller
{

	public $module = 'index'; 

    public function index()
	{
		$data = Blog::all();

		$hots = Blog::orderBy('click','desc')->limit(8)->get();

		$news = Blog::orderBy('id','desc')->limit(5)->get();

		$tags = Tag::tagsCloud();

		$tool = new Tool;
		$wea = $tool->weather();

		return view('front.index',[
			'blogs'=>$data,
			'hots'=>$hots,
			'news'=>$news,
			'tags'=>$tags,
			'wea'=>$wea,
			'name'=>'文章',
		]);
	}
}