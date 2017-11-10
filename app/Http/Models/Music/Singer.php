<?php
namespace App\Http\Models\Music;
use Illuminate\Database\Eloquent\Model;
/**
* 
*/
class Singer extends Model
{
    protected $table = 'qcmusic_singers';

    public $primaryKey = 'sid';
    
    public $timestamps = false;

    public function audios() {
        return $this->belongsToMany('App\Http\Models\Music\Audio', 'qcmusic_audio_singer', 'sid', 'aid');
    }

    public function discs() {
        return $this->hasMany('App\Http\Models\Music\Disc', 'sid');
    }
    
}