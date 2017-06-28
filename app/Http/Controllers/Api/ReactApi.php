<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
use App\Http\Models\Tag;
use App\Http\Models\Cate;
use App\Http\Models\User;
use Illuminate\Http\Request;

class ReactApi extends Controller {
	public function __construct()
	{
		// 指定允许其他域名访问  
		header('Access-Control-Allow-Origin:*');  
		// 响应类型  
		// header('Access-Control-Allow-Methods:GET');  
		// 响应头设置  
		header('Access-Control-Allow-Headers:x-requested-with,content-type');  
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
		return $blogs;
	}

	public function showBlog(Request $request)
	{
		$blog = Blog::find(request('id'));
		$blog->click++;
		$blog->save();
		$blog->content = preg_replace('/\/upload\/image\/\d+\/\d+\.\w{3}/','http://zmhjy.xyz${0}',$blog->content);
		$blog->user = User::where('id',$blog->user_id)->select('nickname','email')->first();
		$blog->tagsarr = Tag::tagsarr($blog->tags);
		$blog->cate = Cate::where('id',$blog->cate_id)->select('name','alias')->first();
		$blog->prev = Blog::select('id','title')->where('id','<',$blog->id)->orderBy('id','desc')->first();
		$blog->next = Blog::select('id','title')->where('id','>',$blog->id)->orderBy('id','asc')->first();
		return $blog;
	}


}