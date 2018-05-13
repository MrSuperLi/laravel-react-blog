<?php namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;
use Cache, Redirect, Input, Auth,Mail;
use Illuminate\Http\Response;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{

		$cacheName = 'homePage'.intval(Input::get('page'));
		if (!Cache::has('$cacheName')) {
			$articles = Article::select(array('id','title','summary','updated_at','created_at'))
			->orderBy('created_at','DESC')->paginate(10);
			//$articles->appends(Input::get());       //Ìí¼Ó²ÎÊý
			//$articles->fragment('li');              //Ãªµã
			//$articles->setPath('custom/url') ;      //Â·¾¶
			//$articles = Article::simplePaginate(1); //Ð¡ÐÍ·ÖÒ³
			if (!count($articles)) {
				throw new NotFoundHttpException;
			}
			Cache::put($cacheName,$articles,1440);
		}
		$articles = Cache::get($cacheName);
		$page = '<div style="text-align:center">'.$articles->render().'</div>';
		
		return view('index')->withArticles($articles)->withPage($page);
	}

	public function show($id){
		$id = intval($id);
		$cacheName = 'article'.$id;
		if (!Cache::has($cacheName)) {
			$article = Article::find($id);
			Cache::put($cacheName,$article,2880);
		}
		$article = Cache::get($cacheName);
		if (!$article)
			throw new NotFoundHttpException;
		return view('show')->withArticle($article)->withAdminname('¹ÜÀíÔ±');
	}

	//CommentsRequest
	public function store(Request $request){

		$refrere = $_SERVER['HTTP_REFERER'];
		$host = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '');
		if (strpos($refrere, $host) === false) {
			throw new NotFoundHttpException;
		}
		unset($refrere,$host);

		$this->validate($request,[
			'article_id'=>'required|integer|exists:articles,id',
			'comment_id'=>'integer|exists:comments,id',
			'name'=>'required|max:15',
			'email'=>'required|max:40|email',
			'content'=>'required|max:350',
			'admin' => 'boolean',
		]);
		
		$data = $request->except(['_method','_token','submit','reset','id','admin']);
		foreach ($data as $key => $value) {
			$data[$key] = $this->decode2html($value);
		}
		$data['admin'] = 0;
		if ($this->isAdmin()) {
			$data['admin'] = 1;
			$data['name']  = '';
			$data['email'] = '';
		}
		if (Comment::create($data)) {
			//$request->flash();
			return Redirect::back()->withInput();
		}
		return Redirect::back()->withErrors('ÆÀÂÛÊ§°Ü£¡');
	}

	public function decode2html($value){
		return is_string($value)?htmlspecialchars($value):$value;
	}

	public function isAdmin(){
		return Auth::check() && Auth::user()->id === 1;
	}
}
