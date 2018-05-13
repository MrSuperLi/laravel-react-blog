<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\Subscribers\TestSubscriber;
use Event;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
		/*'App\Events\Test' => [
			'App\Handlers\Events\TestHandler',
			'App\Handlers\Events\TestHandler1',
		],*/
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);
		//
		
		//Event::subscribe(new TestSubscriber);
		//或
		//Event::subscribe('App\Events\Subscribers\TestSubscriber');
	}

}
