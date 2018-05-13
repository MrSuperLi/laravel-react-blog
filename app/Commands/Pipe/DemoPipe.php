<?php namespace App\Commands\Pipe;

use Closure;
use App\Commands\Demo;
use App\Commands\Command;

class DemoPipe{

	public function handle(Command $command,Closure $next){
		if ($command instanceof Demo) {
			echo 'Demo Commands Pipe:'.__FILE__;
			if (is_array($command->config)) {
				$command->config['email'] = env('MAIL_USERNAME');
			}
		}
		return $next($command);
	}
}


?>