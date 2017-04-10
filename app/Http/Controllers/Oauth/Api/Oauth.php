<?php
namespace App\Http\Controllers\Oauth\Api;

use App\Http\Controllers\Oauth\Oaserver;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Http\Request;
use App\Http\Models\User;
use App\Http\Controllers\Oauth\Api\RequestX as GuRequest;

class Oauth 
{
	public $oaserver;
	public $response;
	public $code;

	public function __construct(Oaserver $oaserver)
	{
		$this->oaserver = $oaserver;
		var_dump($this->oaserver);
		
	}


	public function init(Request $request)
	{
		$this->response['redirect_url'] = $this->oaserver->redirect_url;
		$this->response['client_id'] = $this->oaserver->client_id;
		return redirect('/oauth/login?'.http_build_query($this->response));
	}

	public function authLogin(Request $request)
	{
		
		$req = http_build_query($request->input());
		return view('test',['req'=>$req]);
	}

	public function authCode(Request $request)
	{
		$this->code = '123456789abcdrfg';
		if (request('user')==request('pass')) {
			$response['code'] = $this->code;
			return redirect(request('redirect_url').'?'.http_build_query($response));
		}
		echo "fail";		
	}

	public function authToken()
	{
		$token = 'gnw12d34gKLNL4knlk91m';
		var_dump($this->oaserver);


	}




}