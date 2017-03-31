<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
use App\Http\Models\Tag;
use Illuminate\Support\Facades\Input;
use Cache;

class BlogController extends Controller
{
	public $module = 'blog'; 

	public function index($cate=null)
	{
		
		$tags = Tag::tagsCloud();

		if ($cate) {
			$blogs = Blog::join('cates', 'cate_id', '=', 'cates.id')->where('cates.alias',$cate)->get();
		}else{
			$blogs = Blog::all();
		}
		
		return view('front.blog.index',[
			'blogs'=>$blogs,
			'tags'=>$tags,
			'name'=>'文章',
		]);
	}

	public function findByTag($tag=null)
	{
		
		$tags = Tag::tagsCloud();

		if ($tag) {
			$blogs = Blog::where('tags','like',"%$tag%")->get();
		}else{
			$blogs = Blog::all();
		}
		
		return view('front.blog.index',[
			'blogs'=>$blogs,
			'tags'=>$tags,
			'name'=>'文章',
		]);
	}



	public function show($id)
	{
		$blogs = Blog::all();
		$blog = Blog::find($id);
		$blog->click += 1;
		$blog->save();

		
		return view('front.blog.detail',[
			'blog'=>$blog,
			'blogs'=>$blogs,
		]);
	}



}
