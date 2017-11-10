<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Music\Audio;
use App\Http\Models\Music\AudioList;
use App\Http\Models\Music\Disc;
use App\Http\Models\Music\Singer;
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
        $audio->singer = $audio->singer();
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

    public function getAudios(){
        $audios = Audio::all();
        return $audios;
    }

    public function getDetail($name){
        $lists = AudioList::all();
        return $lists;
    }

    public function getHotKeys(){
        $res = [];
        $audios = Audio::orderBy('count', 'desc')
               ->take(3)
               ->get();
        foreach ($audios as $audio) {
            $res[] = $audio->title;
        }
        $discs = Disc::inRandomOrder()
               ->take(3)
               ->get();
        foreach ($discs as $disc) {
            $res[] = $disc->title;
        }
        $singers = Singer::inRandomOrder()
               ->take(3)
               ->get();
        foreach ($singers as $singer) {
            $res[] = $singer->name;
        }
        $res = array_unique($res);
        array_splice($res,array_search('群星',$res),1);
        return $res;
    }

    public function search($key){
        $res = [];
        $disc = $this->searchDisc($key);
        $singer = $this->searchSinger($key);
        if (isset($disc)) {
            array_push($res, $disc);
        }
        if (isset($singer)) {
            array_push($res, $singer);
            $temp = $singer->audios;
            foreach ($temp as $audio) {
                $audio->disc = $audio->disc;
                $audio->singer = $audio->singer();
                $audio->type = 'audio';
                $audios[] = $audio;
            }
        } else {
            $audios = $this->searchAudios($key);
        }
        if (empty($res)) {
            return $audios;
        }
        return array_merge($res,$audios);
    }

    public function searchDisc($key){
        $discs = Disc::with('singer')->where('title','like','%'.$key.'%')->inRandomOrder()->take(1)->get();
        if (count($discs)) {
            $disc = $discs[0];
            $disc->type = 'disc';
            return $disc;
        }
    }

    public function searchSinger($key){
        $singers = Singer::withCount('discs')->withCount('audios')->where('name','like','%'.$key.'%')->inRandomOrder()->take(1)->get();
        if (count($singers)) {
            $singer = $singers[0];
            $singer->type = 'singer';
            return $singer;  
        } 
    }

    public function searchAudios($key){
        $res = [];
        foreach (Audio::where('title','like','%'.$key.'%')->cursor() as $audio) {
            $audio->disc = $audio->disc;
            $audio->singer = $audio->singer();
            $audio->type = 'audio';
            $res[] = $audio;
        }
        return $res;
    }




}