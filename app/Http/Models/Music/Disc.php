<?php
namespace App\Http\Models\Music;
use Illuminate\Database\Eloquent\Model;
/**
* 
*/
class Disc extends Model
{
    protected $table = 'qcmusic_discs';

    public $primaryKey = 'did';
    
    public $timestamps = false;

    public function getImgAttribute($value)
    {
        return 'http://oxjyut4f0.bkt.clouddn.com/image/'.$value;
    }

    public function singer() {
        return $this->belongsTo('App\Http\Models\Music\Singer', 'sid');
    }

    public function singerName() {
        $singer = $this->singer;
        return $singer->name;
    }
    
}