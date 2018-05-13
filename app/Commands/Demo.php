<?php namespace App\Commands;

use App\Commands\Command;
use Config;
use Illuminate\Contracts\Bus\SelfHandling;

class Demo extends Command implements SelfHandling{

	public $config;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($config)
	{
		$this->config = $config;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		//dd(Config::get('app.aliases'));
		//echo __CLASS__;
		//dd($this->config);
		var_dump($this->config);
	}

}
