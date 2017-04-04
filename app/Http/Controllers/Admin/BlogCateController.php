<?php
namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Cate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect, Auth,Image;

class BlogCateController extends Controller
{
	public $module = 'blogcate'; 
	
	public function index()
	{
		$cates = Cate::all();
		return view('admin.blog.cate',[
			'cates'=>$cates,
		]);
	}

	public function recovery(Request $request)
	{
		return Cate::find($request->input('id'));
	}

	public function aSave(Request $request)
	{
		if ($request->input('id')) {
			return $this->update($request);
		}else{
			return $this->store($request);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'alias' => 'required|unique:cates,alias',
			'name' => 'required|unique:cates,name',
		]);

		$cate = new Cate;
		$cate->alias = $request->input('alias');
		$cate->name = $request->input('name');

		if ($cate->save()) {
			return $cate->id;
		} else {
			return $errors->first();
		}

	}

	public function update(Request $request)
	{
		$this->validate($request, [
			'alias' => 'required|unique:cates,alias,'.$request->input('id'),
			'name' => 'required|unique:cates,name,'.$request->input('id'),
		]);

		$cate = Cate::find(Input::get('id'));
		$cate->alias = Input::get('alias');
		$cate->name = Input::get('name');
		if ($cate->save()) {
			return 'success';
		}else{
			// foreach ($errors->all('<li>:message</li>') as $message) {
			//     $err .= $message.'<br>';
			// }
			return 'fail';
		}
		

	}



}