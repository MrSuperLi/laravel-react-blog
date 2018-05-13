<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Comment;
use Redirect, Input;
use Illuminate\Pagination\Page;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Illuminate\Http\Request;

class CommentsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		$params = $this->pageHtml();
		return view('admin.comments.index')->withComments($params[0])->withPage($params[1]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		throw new NotFoundHttpException;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request,[
			'article_id'=>'required|integer|exists:articles,id',
			'comment_id'=>'integer|exists:comments,id',
			'name'=>'max:15',
			'email'=>'max:40|email',
			'content'=>'required|max:350',
		]);
		
		$data = Input::except(['_method','_token','submit','reset','id']);
		foreach ($data as $key => $value) {
			$data[$key] = $this->encode2Html($value);
		}
		$data['admin'] = 1;
		$data['name']  = '';
		$data['email'] = '';
		if (Comment::create($data)) {
			return Redirect::back();
		}
		return Redirect::back()->withErrors('评论失败！');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$comment = Comment::find(intval($id));
		if (!$comment) {
			throw new NotFoundHttpException;
		}
		return view('admin.comments.edit')->withComment($comment);
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
			'name' => 'required|max:15',
			'email' => 'required|email|max:40',
			'content'  => 'required',
		]);

		$comment = Comment::find(intval($id));
		$back    = Redirect::back();
		if (!$comment) {
			return $back->withErrors('您修改的推文不存在！');
		}else{
			$comment->content    = $this->encode2Html(Input::get('content'));
			if (!$comment->admin) {
				$comment->name   = $this->encode2Html(Input::get('name'));
				$comment->email = $this->encode2Html(Input::get('email'));
			}
			if ($comment->save()){
				return $back->withInput()->with('status',1);
			}else{
				return $back->withInput()->withErrors('输入的内容不符合规范！');
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
		$comment =Comment::find(intval($id));
		if (!$comment) {
			return Redirect::back()->withErrors('评论在本操作前已经不存在！');
		}elseif($comment->delete()){
			return Redirect::back()->with('status',1);
		}
		return Redirect::back()->withErrors('删除评论出错！');
	}

	public function encode2Html($value){
		return is_string($value)?htmlspecialchars($value):$value;
	}

	public function pageHtml($num = 10,$maxpage = 5){
		$comments = Comment::paginate($num);
		$page     = '';
		if ($comments->lastPage() >= $maxpage+5) {
			//括号不能去除
			$page = (new Page($comments->total(),$comments->perPage(),$maxpage))->show();
		}else{
			$page = '<div style="text-align:center">'.$comments->render().'</div>';
		}
		return [$comments,$page];
	}

}
