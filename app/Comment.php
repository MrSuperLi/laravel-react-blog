<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	protected $fillable = ['article_id','comment_id','name','email','content','admin'];

}
