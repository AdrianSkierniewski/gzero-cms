<?php namespace Gzero\Seeds;

use Gzero\Models\Tag\Tag;
use Gzero\Models\Tag\TagTranslation;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder {

    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 40; $i++) {
            $tag = Tag::create(array('is_active' => 1));
            $tag->translations()->save(
                new TagTranslation(array(
                    'is_active' => 1,
                    'lang_id'   => rand(1, 5),
                    'name'      => $faker->text(23)
                ))
            );

            $tag->contents()->attach(rand(1, 10));
        }


    }

}
