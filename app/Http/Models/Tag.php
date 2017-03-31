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

	public static function tagsUniStr($tags)
	{
		$arr = array_unique(self::tagsArr($tags));
		return implode( ',', $arr );
	}

	public static function addTags($tags)
	{
		if (empty($tags)) return;
		var_dump($tags);
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

		}
	}

    public static function tagsCloud()
    {
    	$tagString ='';
		$fontStyle = array("1"=>"danger",
				"5"=>"info",
				"4"=>"warning",
				"3"=>"primary",
				"2"=>"success",
		);
		$fontSize = array("1"=>"",
				"5"=>"am-text-sm",
				"4"=>"am-text-default",
				"3"=>"am-text-lg",
				"2"=>"am-text-xl",
		);
		$tags = Tag::orderBy('frequency', 'desc')->get();
		foreach ($tags as $tag)
		{
			$tagString.='<a href="'.url('blog/tag='.$tag->tagname).'"><span class="am-badge am-radius am-badge-'
					.$fontStyle[mt_rand(1,5)].' '.$fontSize[mt_rand(1,5)].'">'.$tag->tagname.'</span></a>';
		}

		return $tagString;
    }

}