<?php namespace App\Events\Subscribers;

class TestSubscriber{

	public function test($event){
		echo 'test';
		return 'test';
	}

	public function test1($event){
		echo '<br/>test1<br/>';
		return 'test1';
	}

	public function subscribe($events){
		$events->listen('App\Events\Test','App\Events\Subscribers\TestSubscriber@test');
		$events->listen('App\Events\Test','App\Events\Subscribers\TestSubscriber@test1');
	}
}


?>