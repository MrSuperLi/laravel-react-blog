<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use Redirect, Input;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Illuminate\Http\Request;

class ArticlesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$maxpage  = 6;
		$articles = Article::select(array('id','title','summary','updated_at','created_at'))
			->orderBy('updated_at','DESC')->paginate(10);
		if (!count($articles)) {
			abort(404);
		}
		$page = '<div style="text-align:center">'.$articles->render().'</div>';
		return view('admin.articles.index')->withArticles($articles)->withPage($page);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.articles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		$this->validate($request,[
			'title' => 'required|max:100',
			'summary' => 'required|max:100',
			'body'  => 'required',
		]);

		$article          = new Article;
		$article->title   = $this->encode2Html(Input::get('title'));
		$article->summary = $this->encode2Html(Input::get('summary'));
		$article->body    = Input::get('body');
		$back             = Redirect::back();

		if ($article->save()){
			return $back->with('status',1);
		}else{
			return $back->withInput()->withErrors('输入的内容不符合规范！');
			//无论怎样打开页面$errors都是存在的
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$article = Article::find(intval($id));
		if (!$article)
			throw new NotFoundHttpException;
		return view('admin.articles.show')->withArticle($article)->withAdminname('管理员');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$article = Article::find(intval($id));
		if (!$article)
			throw new NotFoundHttpException;
		return view('admin.articles.edit')->withArticle($article);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$this->validate($request,[
			'title' => 'required|max:100',
			'summary' => 'required|max:100',
			'body'  => 'required',
		]);

		$article = Article::find(intval($id));
		$back    = Redirect::back();
		if (!$article) {
			return $back->withErrors('您修改的推文不存在！点击<a class="btn btn-success" href="/home/articles/create">新建</a>');
		}else{
			$article->title   = $this->encode2Html(Input::get('title'));
			$article->summary = $this->encode2Html(Input::get('summary'));
			$article->body    = Input::get('body');

			if ($article->save()){
				return $back->with('status',1);
			}else{
				return $back->withErrors('输入的内容不符合规范！');
			}
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$article = Article::find(intval($id));
		if (!$article) {
			return Redirect::back()->withErrors('推文在本操作前已经不存在！');
		}else if($article->delete()){
			return Redirect::back();
		}
		return Redirect::back()->withErrors('删除推文出错！');
		//ALTER TABLE comments add FOREIGN KEY comments_article (`article_id`) REFERENCES articles (`id`) ON DELETE CASCADE ON UPDATE CASCADE
		//通过上诉外间约束来删除表对应的评论过
	}

	public function encode2Html($str = ''){
		return is_string($str)?htmlspecialchars($str):$str;
	}

}
