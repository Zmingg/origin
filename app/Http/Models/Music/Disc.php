<?php
namespace App\Http\Models\Music;
use Illuminate\Database\Eloquent\Model;
/**
* 
*/
class Disc extends Model
{
    protected $table = 'qcmusic_discs';

    public $primaryKey = 'sid';
    
    public $timestamps = false;

    public function getImgAttribute($value)
    {
        return 'http://oxjyut4f0.bkt.clouddn.com/image/'.$value;
    }
    
}