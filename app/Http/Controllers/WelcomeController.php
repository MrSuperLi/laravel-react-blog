<?php namespace App\Http\Controllers;

use Bus,Log;
use App\Commands\Demo;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Event,Mail;

class WelcomeController extends Controller {

	use DispatchesCommands;
	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$this->dispatch(new Demo());
		//Bus::dispatch(new Demo);
		
		var_dump(Event::fire(new \App\Events\Test));

		die;
		$this->dispatchFrom(Demo::class,
			collect([
				'config' => [
					'name' => 'Taylor swift',
					'age'  => 27,
				],
			]),
			[
				'name' => 'Taylor',
			]
		);
		//return view('welcome');
	}

	public function form(){
		return view('test.form');
	}

	public function error($method){
		$method = strtolower($method);
		Log::{$method}('Exception:',['name'=>'xiaoli','school'=>'scau']);
	}

	public function mail(){
		var_dump(Mail::send('mail',array('name'=>'XIAOLI'),function($message){
			$message->to('1140926800@qq.com','XIAOLI')->subject('TEST');
			$message->attach('F:/image_API/eye.gif');
		}));
		die;
		/*$articles = Article::paginate(10);
		echo $articles->toJson();
		die;*/
	}

	public function session(){
		session()->flash('name','xiaoli');
		session()->flash('age',23);
		session()->flash('addr','scau');
	}

	public function getsession(){
		dd(session()->all());
	}
}
