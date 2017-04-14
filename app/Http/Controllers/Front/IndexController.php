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

		$hots = Blog::orderBy('click','desc')->limit(8)->get();

		$news = Blog::latest()->limit(5)->get();

		$tool = new Tool;

		return view('front.index',[
			'hots'=>$hots,
			'news'=>$news,
			'name'=>'文章',
		]);
	}
}