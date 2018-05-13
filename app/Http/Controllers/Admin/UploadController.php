<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;

class UploadController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	const FILE_PATH = 'E:/xampp/htdocs/xampp/learnlaravel5/public/upload/';

	public function index()
	{
		return view('upload');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		//return response()->json(['use'=>'xiaoli','age'=>20])->setCallback('jsonp');
		$name = 'myFile';
		$back = Redirect::back();
		if (!$request->hasFile($name)) {
			return $back->withErrors('没有可上传文件');
		}

		$files = $request->file($name);
		$isfail = false;
		foreach ($files as $file) {
			if (!$this->moveFile($file)) {
				$isfail = true;
				continue;
			}
		}
		if ($isfail) {
			return $back->withErrors(['文件上传成功','部分文件不可用']);
		}
		return $back->withStatus(1);
	}

	public function moveFile($file,$path = null){
		if (empty($file) || !$file->isValid()) {
			return false;
		}
		$path = $path?$path:(static::FILE_PATH);
		$fileName = iconv('UTF-8', 'GBK', $file->getClientOriginalName().'.'.$file->guessExtension());
		if ($file->move($path,$fileName)) {
			return true;
		}
		return false;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$fileName = static::FILE_PATH.$id;
		if (!file_exists($fileName)) abort(404);
		return response()->download($fileName);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//return response()->caps($id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
