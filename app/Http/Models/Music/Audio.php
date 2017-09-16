<?php
namespace App\Http\Models\Music;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Music\Disc;
/**
* 
*/
class Audio extends Model
{
    protected $table = 'qcmusic_audios';
    
    public $timestamps = false;

    public $primaryKey = 'aid';

    public function disc(){
        return $this->belongsTo('App\Http\Models\Music\Disc', 'sid');
    }


}