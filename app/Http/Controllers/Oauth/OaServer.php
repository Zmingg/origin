<?php
namespace App\Http\Controllers\Oauth;

use Illuminate\Http\Request;

class Oaserver {


	public $client_id;
	public $redirect_url;

	public function __construct(Request $request)
	{
		$this->client_id = $request->input('client_id');
		$this->redirect_url = $request->input('redirect_url');
	}

	public function getClientId()
	{
		return $this->client_id;
	}


	public function getRedirect()
	{
		return $this->redirect_url;
	}




	





	








}