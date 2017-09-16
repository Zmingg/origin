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
}