<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticleTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//DB::table('articles')->delete();

		for ($i=0; $i <10 ; $i++) {
			Article::create([
				'summary' => 'first-grounp',
				'body'    => 'Body '.$i,
				'title'   => 'Title '.$i
			]);
		}
	}

}
