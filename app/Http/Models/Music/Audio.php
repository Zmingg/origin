<?php
namespace App\Http\Models\Music;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Music\Disc;
use App\Http\Models\Music\Singer;
/**
* 
*/
class Audio extends Model
{
    protected $table = 'qcmusic_audios';
    
    public $timestamps = false;

    public $primaryKey = 'aid';

    public function disc(){
        return $this->belongsTo('App\Http\Models\Music\Disc', 'did');
    }

    public function singers(){
        return $this->belongsToMany('App\Http\Models\Music\Singer', 'qcmusic_audio_singer', 'aid', 'sid');
    }

    public function singer(){
        $singers = $this->singers;
        $temp = [];
        foreach ($singers as $singer) {
            $temp[] = $singer->name;
        }
        return implode('/', $temp);
    }

    


}