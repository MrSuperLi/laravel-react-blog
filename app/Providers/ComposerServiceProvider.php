<?php namespace App\Providers;
use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//格式:composer('视图',closure|Class);
		//View::composer('profile','App\Http\ViewComposers\ProfileComposer');
		//view()->composer('dashborad',function(){});
		/*View::composers([
			'App\Http\ViewComposers\AdminComposer' => ['admin.index', 'admin.profile'],
			'App\Http\ViewComposers\UserComposer' => 'user',
			'App\Http\ViewComposers\ProductComposer' => 'product',
		]);*/
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
