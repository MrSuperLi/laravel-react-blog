<?php namespace App\Providers;
use Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *目前还不清楚如何使用
	 * @return void
	 */
	
	/**
	 * 是否缓载，是则定义provides方法
	 * @var boolean
	 */
	protected $defer = true;

	public function boot()
	{
		Response::macro('caps',function($value){
			return $this->make(strtoupper($value));
		});
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		/**
		 * 例子，并无该Contracts与Riak\Connection
		 */
		$this->app->singleton('Riak\Contracts\Connection', function($app){
			return new Riak\Connection($app['config']['riak']);
		});
	}

	/**
	 * 返回提供者所注册的服务容器绑定
	 * @return Riak\Contracts\Connection
	 */
	public function provides(){
		return ['Riak\Contracts\Connection'];
	}

}
