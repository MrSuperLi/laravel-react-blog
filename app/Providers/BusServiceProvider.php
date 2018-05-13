<?php namespace App\Providers;

use App\Commands\Demo;
use Illuminate\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

class BusServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @param  \Illuminate\Bus\Dispatcher  $dispatcher
	 * @return void
	 */
	public function boot(Dispatcher $dispatcher)
	{
		$dispatcher->mapUsing(function($command)
		{
			return Dispatcher::simpleMapping(
				$command, 'App\Commands', 'App\Handlers\Commands'
			);
		});

		/*$dispatcher->pipeThrough([function($command,$next){
			if ($command instanceof Demo) {
				echo 'Demo Commands Pipe:'.__FILE__;
				if (is_array($command->config)) {
					$command->config['pass'] = env('MAIL_PASSWORD');
				}
			}
			return $next($command);
		}]);*/

		//$dispatcher->pipeThrough(['App\Commands\Pipe\DemoPipe']);
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
