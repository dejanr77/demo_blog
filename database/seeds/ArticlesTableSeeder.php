<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Article::class, 30)->create()->each(function($article) {
            $article->tags()->attach(Tag::find(1));
        });
    }
}
