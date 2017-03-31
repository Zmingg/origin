<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //protected $table = 'blogs';

    public function fromDateTime($value){
        return strtotime(parent::fromDateTime($value));
    }

    /**
	 * 获取作者信息
	 */
	public function user(){
	    return $this->belongsTo('App\Http\Models\Admin', 'user_id');
	}

	/**
	 * 获取分类信息
	 */
	public function cate(){
	    return $this->belongsTo('App\Http\Models\Cate', 'cate_id');
	}


}
