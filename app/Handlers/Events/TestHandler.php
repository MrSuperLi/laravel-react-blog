<?php namespace App\Handlers\Events;

use App\Events\Test;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class TestHandler {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  Test  $event
	 * @return void
	 */
	public function handle(Test $event)
	{
		echo 'hsh';
		return false;
	}

}
