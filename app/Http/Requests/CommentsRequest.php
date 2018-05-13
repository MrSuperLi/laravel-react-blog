<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CommentsRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'article_id'=>'required|integer|exists:articles,id',
			'comment_id'=>'integer|exists:comments,id',
			'name'=>'required|max:15',
			'email'=>'required|max:40|email',
			'content'=>'required|max:350',
		];
	}

}
