<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Models\Music\Audio;
use Illuminate\Http\Request;
use Qiniu\Auth;

/**
* 
*/
class MusicApi extends Controller{

    public $auth;
    
    public function __construct(){
        header('Access-Control-Allow-Origin:*');  
        
    }

    public function getAudioData(Request $request){
        $id = $request->id;
        $audio = Audio::find($id);
        // 七牛OSS
        // 用于签名的公钥和私钥
        $accessKey = 'qqma0f1S7NCpqULAbweW9Wc-RQ51riX9taoRydmq';
        $secretKey = 'dASmCaR0St7vIcCikzdPqo25_f3vtlfgR7tCVKQQ';
        // 初始化签权对象
        $this->auth = new Auth($accessKey, $secretKey);
        $baseUrl = 'http://ow7kqez1l.bkt.clouddn.com/'.$audio->src;
        $trueUrl = $this->auth->privateDownloadUrl($baseUrl);
        $audio->expire = time()+3600;
        $audio->url = $trueUrl;
        return $audio;
    }

    public function getSheet(Request $request){
        $data = Audio::all();
        return $data;
    }


}