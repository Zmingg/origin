<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Music\Audio;
use App\Http\Models\Music\AudioList;
use App\Http\Models\Music\Disc;
use App\Http\Models\Blog;
use Illuminate\Http\Request;
use Qiniu\Auth;

/**
* 
*/
class MusicApi extends Controller{

    public $auth;
    // 七牛OSS
    // 用于签名的公钥和私钥
    public $accessKey = 'qqma0f1S7NCpqULAbweW9Wc-RQ51riX9taoRydmq';
    public $secretKey = 'dASmCaR0St7vIcCikzdPqo25_f3vtlfgR7tCVKQQ';
    
    public function __construct(){
        header('Access-Control-Allow-Origin:*');  
        // 初始化签权对象
        $this->auth = new Auth($this->accessKey, $this->secretKey);
    }

    public function getAudio(Request $request){
        $aid = $request->aid;
        $audio = Audio::find($aid);
        $audio->disc = $audio->disc;
        
        // 生成 audio_url
        $baseUrl = 'http://ow7kqez1l.bkt.clouddn.com/audio/'.$audio->src;
        $trueUrl = $this->auth->privateDownloadUrl($baseUrl,3600);
        $audio->expire = time()+3600;
        $audio->src = $trueUrl;
        // 生成 lyric_url
        $baseUrl = 'http://ow7kqez1l.bkt.clouddn.com/lyric/'.$audio->lyric;
        $trueUrl = $this->auth->privateDownloadUrl($baseUrl,3600);
        $audio->lyric = $trueUrl;
        unset($audio->sid);
        return $audio;
    }

    public function getList($lid){
        $data = AudioList::find($lid);
        $data->audios = $data->audios();
        unset($data->aids);
        return $data;
    }

    public function getDisc($sid){
        $disc = Disc::find($sid);
        
        // 生成discImg_url
        $baseUrl = 'http://ow7kqez1l.bkt.clouddn.com/image/'.$disc->img;
        $trueUrl = $this->auth->privateDownloadUrl($baseUrl,3600);
        $disc->expire = time()+3600;
        $disc->img = $trueUrl;
        return $disc;
    }




}