<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
use App\Http\Models\Tag;
use App\Http\Models\Cate;
use Illuminate\Support\Facades\Input;
use Redirect, Auth,Image;

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
		$blog->title = Input::get('title');
		$blog->abstract = Input::get('abstract');
		$blog->content = Input::get('content');
		$blog->cate_id = Input::get('cate_id');
		$blog->user_id = Auth::guard('admin')->user()->id;
		$blog->tags = Tag::tagsUniStr(strtolower(Input::get('tags')));
		


		if (Input::get('thumb_code')!==null) {
			Image::make(Input::get('thumb_code'))->save(Input::get('thumb_src'));
			if (file_exists($blog->thumb_img)) {
				unlink(substr($blog->thumb_img,1));
			}
			$blog->thumb_img = Input::get('thumb_src');
		}else{
			$blog->thumb_img = 'ass_ama/img/thumb_default.jpg';
		}

		if ($blog->save()) {
			Tag::updateTags('',$blog->tags);
			return Redirect::to('admin/blog');
		} else {
			return Redirect::back()->withInput()->withErrors('保存失败！');
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

		$blog = Blog::find($id);
		if ($blog->updated_at!=Input::get('version')) {
			$errors = ['version' => '错误：更新失败。提示：您此前浏览的版本已被其他用户更新。系统已自动为您刷新版本，请查看并重试操作。' ];
			return Redirect::back()->withErrors($errors);
		}

		$blog->title = preg_replace('/\s/','',Input::get('title'));
		$blog->abstract = Input::get('abstract');
		$blog->content = Input::get('content');
		$blog->cate_id = Input::get('cate_id');

		$oldtags = $blog->tags;
		$blog->tags = Tag::tagsUniStr(strtolower(Input::get('tags')));

		if (Input::get('thumb_code')!==null) {
			Image::make(Input::get('thumb_code'))->save(Input::get('thumb_src'));
			if (file_exists($blog->thumb_img)&&$blog->thumb_img!=='ass_ama/img/thumb_default.jpg') {
				unlink($blog->thumb_img);
			}
			$blog->thumb_img = Input::get('thumb_src');
		}

		$blog->user_id = Auth::guard('admin')->user()->id;

		if ($blog->save()) {
			Tag::updateTags($oldtags,$blog->tags);
			return Redirect::to('admin/blog');
		} else {
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
		if (file_exists($blog->thumb_img)&&$blog->thumb_img !== 'ass_ama/img/thumb_default.jpg') {
			unlink($blog->thumb_img);
		}
		Tag::updateTags($blog->tags,'');
		$blog->delete();

		return Redirect::to('admin/blog/');
	}

	

}

