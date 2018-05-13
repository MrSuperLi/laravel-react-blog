<?php namespace App\Http\Controllers\React;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

use Illuminate\Http\Request;

class AuthController extends Controller {

	public function getIsLogin(){
		if(Auth::check()) {
			return returnData(Auth::user());
		}
		return returnMsg('');
	}

	public function postIsLogin(){
		return $this->getIsLogin();
	}

	public function getLogout(){
		Auth::logout();
		return returnData([]);
	}

	public function postLogoout(){
		return $this->getLogout();
	}


}
