<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    // 关闭自动存储更新时间 created_at/update_at
    public $timestamps = false;
    // 主键非 ID  关闭increment
    public $primaryKey = 'tagname';
    public $incrementing = false;

	public static function tagsArr($tags)
	{
		return preg_split( "/[\s,，]+/", $tags ,-1,PREG_SPLIT_NO_EMPTY );	
	}

	// 排除重复tag重新合并str 存入sql
	public static function tagsUniStr($tags)
	{
		$arr = array_unique(self::tagsArr(strtolower($tags)));
		return implode( ',', $arr );
	}

	public static function addTags($tags)
	{
		if (empty($tags)) return;

		foreach ($tags as $tagname){
			$tag = Tag::where('tagname',$tagname)->first();
			$count = Tag::where('tagname',$tagname)->count();

			if (empty($tag)){
				$tag = new Tag;
				$tag->tagname = $tagname;
				$tag->frequency = 1;
				$tag->save();
			} else {
				$tag->frequency += 1;
				$tag->update();
			}
		}
	}

	public static function removeTags($tags)
	{
		if (empty($tags)) return;

		foreach ($tags as $tagname){
			$tag = Tag::where('tagname',$tagname)->first();
			if (empty($tag))  return;

			if ($tag->frequency<=1){
				$tag->delete();
			} else {
				$tag->frequency -= 1;
				$tag->save();
			}
		}
	}

	public static function updateTags($oldtags,$newtags)
	{
		if (!empty($oldtags)||!empty($newtags)) {
			$oldtags_arr = self::tagsArr($oldtags);
			$newtags_arr = self::tagsArr($newtags);
			self::addTags(array_values(array_diff($newtags_arr, $oldtags_arr)));
			self::removeTags(array_values(array_diff($oldtags_arr, $newtags_arr)));
			return true;
		}else{
			return true;
		}

	}



}