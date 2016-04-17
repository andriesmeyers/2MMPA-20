<?php

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = Tag::all();
        factory(Post::class, DatabaseSeeder::AMOUNT['MANY'])->create()
            // Voor elk van de gecreerde posts wordt een tag toegewezen.
            // use $tags -> de functie hieronder kan anders niet aan
            //  de variabele $tags(scope)

            ->each(function ($post) use ($tags) {

                // verschil rand & Random -> random geeft 1 resultaat terug,
                // rand geeft 1 tot 5 terug
                $post->tags()->attach($tags->random(rand(1,5)));
            });
    }
}
