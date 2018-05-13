<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Illuminate\Http\Request;

use App\Extensions\UEditor\Upload;
use App\Extensions\UEditor\ListList;
use App\Extensions\UEditor\Crawler;

class UEditorController extends Controller {


	protected $result = array('state' => '请求地址错误');
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		$config = config('ueditor');
		$input = Input::all();
		switch ($input['action']) {
			case 'config':
				$this->result = $config;
				break;
			case 'uploadimage':
			case 'uploadscrawl':
			case 'uploadvideo':
			case 'uploadfile':
				$this->uploadFile($input,$config);
				break;
			case 'listimage':
			case 'listfile':
				$this->listFile($input,$config);
				break;
			case 'catchimage':
				$this->catchImage($input,$config);
				break;
			default:
				break;
		}
		return $this->getResponse($this->result,Input::get('callback'));
	}

	public function uploadFile($input,$config){
		if (isset($input['action'])) {
			$this->result = (new Upload($input['action'],$config))->getResult();
		}
	}

	public function listFile($input,$config){
		if (isset($input['action'])) {
			$this->result = (new ListList($input,$config))->getResult();
		}
	}

	public function catchImage($input,$config){
		if (isset($input['action'])) {
			$this->result = (new Crawler($input,$config))->getResult();
		}
	}

	public function getResponse($result,$callback = null){
		$response = response()->json($result);
		if ($callback) {
			$response = $response->setCallback($callback);
		}
		return $response;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
