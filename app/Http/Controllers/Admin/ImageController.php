<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// import the Intervention Image Manager Class
use Image;
use App\Http\Models\Blog;

use Illuminate\Http\Request;


class ImageController extends Controller
{


	public function path()
	{

		$filename = md5(mt_rand(1000,9999).time()).'.png';

		$new_path = 'upload/thumbimg/'.$filename;

		return $new_path;


	}



}