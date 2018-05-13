<?php namespace App\Http\Controllers\React;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Article;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Illuminate\Http\Request;

use Validator;

class ArticlesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$articles = Article::select(array('id','title','summary','updated_at','created_at'))
			->orderBy('updated_at','DESC')->paginate(10);
		if (!count($articles)) {
			abort(404);
		}
		return returnData($articles->toArray());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//return returnData($request->all());
		
		if($request->has('id')){
			return $this->update($request, $request->input('id'));
		}

		$validator = Validator::make($request->all(),[
			'title' => 'required|max:100',
			'summary' => 'required|max:100',
			'body'  => 'required',
		]);

		if ($validator->fails()) {
			return returnMsg($validator->errors()->first());
		}

		$article          = new Article;
		$article->title   = $this->encode2Html($request->input('title'));
		$article->summary = $this->encode2Html($request->input('summary'));
		$article->body    = $request->input('body');

		if ($article->save()){
			return returnData([]);
		}else{
			return returnMsg('输入的内容不符合规范！');
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
		$article = Article::select(array('id','title','summary','updated_at','created_at','body'))->find(intval($id));
		if (!$article)
			throw new NotFoundHttpException;
		return returnData($article);
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
		$validator = Validator::make($request->all(),[
			'title' => 'required|max:100',
			'summary' => 'required|max:100',
			'body'  => 'required',
		]);

		if( $validator->fails() ){
			return returnMsg($validator->errors()->first());
		}

		$article = Article::find(intval($id));
		if (!$article) {
			return returnMsg('文章不存在');
		}else{
			$article->title   = $this->encode2Html($request->input('title'));
			$article->summary = $this->encode2Html($request->input('summary'));
			$article->body    = $request->input('body');

			if ($article->save()){
				return returnData([]);
			}else{
				return returnMsg('输入的内容不符合规范！');
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
			return returnMsg('推文在本操作前已经不存在！');
		}else if($article->delete()){
			return returnData([]);
		}
		return returnMsg('删除推文出错！');
		//ALTER TABLE comments add FOREIGN KEY comments_article (`article_id`) REFERENCES articles (`id`) ON DELETE CASCADE ON UPDATE CASCADE
		//通过上诉外间约束来删除表对应的评论过
	}

	public function encode2Html($str = ''){
		return is_string($str)?htmlspecialchars($str):$str;
	}

}
