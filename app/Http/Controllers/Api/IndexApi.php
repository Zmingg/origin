<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
use App\Http\Models\Tag;
use App\Http\Models\Cate;
use App\Http\Models\User;
use Illuminate\Http\Request;

class IndexApi extends Controller
{
	private $response; 
	private $callback;

	public function __construct()
	{
		$this->callback = request('api');
	}

	public function all(Request $request)
	{
		if (request('cate')) {
			$cateid = Cate::where('alias',request('cate'))->first()->id;
			$blogs = Blog::select('id','abstract','tags','click','title','thumb_img')
				->where('cate_id',$cateid)
				->latest()
				->paginate(request('count'));
		}elseif (request('tag')) {
			$blogs = Blog::where('tags','like','%'.request('tag').'%')
					->select('id','title','thumb_img','abstract','tags','click')
					->latest()
					->paginate(request('count'));
		}else{
			$blogs = Blog::select('id','abstract','tags','click','title','thumb_img')
				->orderBy('click','desc')
				->paginate(request('count'));
		}

		foreach ($blogs as $blog) {
			$blog->tagsarr = Tag::tagsarr($blog->tags);
		}
		$this->response = $blogs;
		$this->callback();
	}


    public function hots(Request $request)
	{
		$this->response = Blog::select('id','title','thumb_img')->orderBy('click','desc')->take(request('count'))->get();
		$this->callback();		
	}

	public function news(Request $request)
	{
		$this->response = Blog::select('id','title')->latest()->take(request('count'))->get();
		$this->callback();	
	}

	public function tags(Request $request)
	{
		$this->response = Tag::select('tagname')->inRandomOrder()->take(request('count'))->get();
		$this->callback();	
	}

	public function cates(Request $request)
	{
		$this->response = Cate::all();
		$this->callback();
	}

	public function blogshow(Request $request)
	{
		$blog = Blog::find(request('id'));
$blog->click++;
$blog->save();
		$blog->content = preg_replace('/\/upload\/image\/\d+\/\d+\.\w{3}/','http://zmhjy.xyz${0}',$blog->content);
		$blog->user = User::where('id',$blog->user_id)->select('nickname','email')->first();
		$blog->tagsarr = Tag::tagsarr($blog->tags);
		$blog->cate = Cate::where('id',$blog->cate_id)->select('name','alias')->first();
		$this->response = $blog;
		$this->callback();

	}

	public function callback()
	{
		echo $this->callback.'('.json_encode($this->response).')';
	}


	
}