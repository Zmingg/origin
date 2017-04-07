<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;
use App\Http\Models\Cate;
use App\Http\Models\Tag;
use Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $module; // 模块 绑定前台active_on属性
    public function __construct()
    {
        View::share('active_on', $this->module);
        View::share('cates', Cate::all());
        View::share('tags', Tag::inRandomOrder()->get());
    }
}
