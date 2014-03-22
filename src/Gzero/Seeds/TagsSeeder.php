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
                    'lang_code' => $faker->randomElement(['pl', 'de', 'en', 'fr', 'ru']),
                    'name'      => $faker->text(23),
                    'is_active' => 1
                ))
            );

            $tag->contents()->attach(rand(1, 10));
        }


    }

}
