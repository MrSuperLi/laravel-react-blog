<?php namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);

		/*Blade::extend(function($view,$compiler){
			$pattern = $compiler->createOpenMatcher('datetime');
			return preg_replace($pattern, '<?php echo date(\'Y-m-d H:i:s\',time());?>', $view);
		});*/

		//bind将Contract绑定实例，以便构造器或方法的依赖注入
		/*$this->app->bind('App\Contracts\TestContract',function(){
			return new TestService;
		});*/

		//根据环境加载服务提供者，而不是config/app.php全局加载
		/*if ($this->app->environment('production')) {
			$this->app->register('App\Providers\ResponseMacroServiceProvider');
		}*/

		/**
		 * $this->app->tagged('myTag')返回一个标记该标签的数组，元素是借口的实现
		 */
		//$this->app->tag('Illuminate\Contracts\Auth\Registrar','myTag');
	}

}
