<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
use App\Http\Models\Tag;
use App\Http\Models\Cate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Cache;

class BlogController extends Controller
{
	public $module = 'blog'; 

	public function index(Request $request,$cate=null)
	{
		$tags = Tag::tagsCloud();

		$blogs = $this->jpull($request,$cate);

		$hots = Blog::orderBy('click','desc')->take(5)->get();

		return view('front.blog.index',[
			'blogs'=>$blogs,
			'tags'=>$tags,
			'cate'=>$cate,
			'hasmore'=>$blogs->hasMorePages(),
			'tag'=>request('tag'),
			'hots'=>$hots
		]);
	}

	public function jpull(Request $Request,$cate=null){

		$cate = isset($cate)?$cate:request('cate');
		// tag查询结果
		if (request('tag')) {
			$jblogs = Blog::where('tags','like','%'.request('tag').'%')
					->select('id','title','thumb_img','abstract','tags','click')
					->orderBy('id','desc')
					->paginate(4);
		}
		// cate查询结果
		elseif ($cate) {
			$cate_id = Cate::where('alias',$cate)->first()->id;
			$jblogs = Blog::where('cate_id',$cate_id)
					->select('id','title','thumb_img','abstract','tags','click')
					->orderBy('id','desc')
					->paginate(4);
		// 无参数输出all
		}else{
			$jblogs = Blog::select('id','title','thumb_img','abstract','tags','click')
					->orderBy('id','desc')
					->paginate(4);
		}
		return $jblogs;
	}

	// public function findByTag($tag=null)
	// {
		
	// 	$tags = Tag::tagsCloud();

	// 	if ($tag) {
	// 		$blogs = Blog::where('tags','like',"%$tag%")->get();
	// 	}else{
	// 		$blogs = Blog::all();
	// 	}
		
	// 	return view('front.blog.index',[
	// 		'blogs'=>$blogs,
	// 		'cate'=>null,
	// 		'tag'=>$tag,
	// 		'tags'=>$tags,
	// 		'name'=>'文章',
	// 	]);
	// }

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

	public function pull()
	{
		$blog = Blog::select('title','thumb_img','abstract','tags','click')->whereIn('id',[4,28])->get();
		return $blog->toJson();
	}



}
