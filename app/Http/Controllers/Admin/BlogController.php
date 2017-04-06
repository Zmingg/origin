<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
use App\Http\Models\Tag;
use App\Http\Models\Cate;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Db;
use Redirect,Auth,Image;

class BlogController extends Controller
{
	public $module = 'blog'; 
	
	public function index()
	{
		$data = Blog::all();

		return view('admin.blog.index',[
			'blogs'=>$data,
			'name'=>'文章',
		]);
	}
    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$cates = Cate::all();
		return view('admin.blog.create',[
			'cates'=>$cates,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required|unique:blogs|max:255',
			'content' => 'required',
		]);

		$blog = new Blog;
		$blog->title = preg_replace('/\s/','',request('title'));
		$blog->abstract = request('abstract');
		$blog->content = request('content');
		$blog->cate_id = request('cate_id');
		$blog->user_id = Auth::guard('admin')->user()->id;
		$blog->tags = is_null(request('tags'))?null:Tag::tagsUniStr(request('tags'));

		if (request('thumb_code')!==null) {
			Image::make(request('thumb_code'))->save(request('thumb_src'));
			$blog->thumb_img = request('thumb_src');
		}else{
			$blog->thumb_img = 'ass_ama/img/thumb_default.jpg';
		}

		DB::beginTransaction();
		$res1 = $blog->save();
		$res2 = Tag::updateTags('',$blog->tags);
		if (!$res1||!$res2) {
			DB::rollBack();
			return Redirect::back()->withInput()->withErrors('保存失败！');
		}else{
			DB::commit();
			return Redirect::to('admin/blog');
		}


	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// $cates = Cate::all();
		return view('admin.blog.edit')->withCates(Cate::all())->withBlog(Blog::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$this->validate($request, [
			'title' => 'required|unique:blogs,title,'.$id.'|max:255',
			'content' => 'required',
		]);

		// 操作前核对当前版本是否一致(update时间) 
		$blog = Blog::find($id);
		if ($blog->updated_at!=request('version')) {
			$errors = ['version' => '错误：更新失败。提示：您此前浏览的版本已被其他用户更新。系统已自动为您刷新版本，请查看并重试操作。' ];
			return Redirect::back()->withErrors($errors);
		}

		$blog->title = preg_replace('/\s/','',request('title'));
		$blog->abstract = request('abstract');
		$blog->content = request('content');
		$blog->cate_id = request('cate_id');
		$oldtags = $blog->tags;
		$blog->tags = is_null(request('tags'))?null:Tag::tagsUniStr(request('tags'));
		$blog->user_id = Auth::guard('admin')->user()->id;

		// save & update 缩略图
		if (request('thumb_code')!==null) {
			Image::make(request('thumb_code'))->save(request('thumb_src'));
			if (file_exists($blog->thumb_img)&&$blog->thumb_img!=='ass_ama/img/thumb_default.jpg') {
				unlink($blog->thumb_img);
			}
			$blog->thumb_img = request('thumb_src');
		}

		DB::beginTransaction();
		$res1 = $blog->save();
		$res2 = Tag::updateTags($oldtags,$blog->tags);

		if ($res1&&$res2) {
			DB::commit();
			return Redirect::to('admin/blog');
		} else {
			DB::rollBack();
			return Redirect::back()->withInput()->withErrors('保存失败！');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$blog = Blog::find($id);

		DB::beginTransaction();
		$res1 = $blog->delete();
		$res2 = Tag::updateTags($blog->tags,'');

		if ($res1&&$res2) {
			DB::commit();
			if (file_exists($blog->thumb_img)&&$blog->thumb_img !== 'ass_ama/img/thumb_default.jpg') {
				unlink($blog->thumb_img);
			}
			return 'success';
		} else {
			DB::rollBack();
			return false;
		}

	}

	

}

