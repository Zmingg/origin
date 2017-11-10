<?php
namespace App\Http\Models\Music;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Music\Audio;
/**
* 
*/
class AudioList extends Model
{
    protected $table = 'qcmusic_lists';

    public $primaryKey = 'lid';
    
    public $timestamps = false;

    /**
     * 获取曲目信息
     */
    public function audios(){
        $aidArr = preg_split( "/[\s,，]+/", $this->aids ,-1,PREG_SPLIT_NO_EMPTY );
        $audios = [];
        foreach ($aidArr as $aid) {
            $audio = Audio::find($aid);
            $audio->singer = $audio->singer();
            $audio->disc = $audio->disc;
            $audios[] = $audio;
        }
        return $audios;
    }

    public function getImgAttribute($value)
    {
        return 'http://oxjyut4f0.bkt.clouddn.com/image/'.$value;
    }
}