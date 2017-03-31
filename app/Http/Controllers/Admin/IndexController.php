<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Blog;

class IndexController extends controller
{
	public $module = 'index'; 

    public function index()
	{
		$data = Blog::all();

		return view('admin.index',[
			'blogs'=>$data,
			'name'=>'文章',
		]);
	}
}