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
        // header('Access-Control-Allow-Origin:*');  
        // 初始化签权对象
        $this->auth = new Auth($this->accessKey, $this->secretKey);
    }

    public function getAudio(Request $request){
        $aid = $request->aid;
        $audio = Audio::find($aid);
        $audio->disc = $audio->disc;
        unset($audio->sid);

        $audio->expire = $request->expire;
        // 生成 audio_url
        $baseUrl = 'http://ow7kqez1l.bkt.clouddn.com/audio/'.$audio->src;
        $audio->src = $this->auth->privateDownloadUrl($baseUrl,$audio->expire-time());  
        // 生成 lyric_url
        if($audio->lyric!==''){
            $baseUrl = 'http://ow7kqez1l.bkt.clouddn.com/lyric/'.$audio->lyric;
            $audio->lyric = $this->auth->privateDownloadUrl($baseUrl,$audio->expire-time());
        }
        return $audio;
    }

    public function getList($lid){
        $list = AudioList::find($lid);
        $list->audios = $list->audios();
        unset($list->aids);
        return $list;
    }

    public function getDisc($sid){
        $disc = Disc::find($sid); 
        return $disc;
    }

    public function getAllList(){
        $lists = AudioList::all();
        return $lists;
    }




}