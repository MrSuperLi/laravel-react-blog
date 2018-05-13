<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AuthenticateWithOnceBasic {
	
	protected $auth;
	/**
	 * [__construct description]
	 * @param Guard $auth [description]
	 */
	function __construct(Guard $auth){
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		return $this->auth->onceBasic() ?: $next($request);
	}

}
