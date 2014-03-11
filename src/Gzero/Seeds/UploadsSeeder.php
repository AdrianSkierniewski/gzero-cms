<?php namespace Gzero\Seeds;

use Gzero\Models\Content\Content;
use Gzero\Models\Upload\Upload;
use Gzero\Models\Upload\UploadType;
use Illuminate\Database\Seeder;


class UploadsSeeder extends Seeder {

    public function run()
    {
        $types = array(
            'thumb',
            'photo',
            'audio',
            'video',
            'doc'
        );
        foreach ($types as $type) {
            UploadType::create(array('name' => $type));
        }

        $faker   = \Faker\Factory::create();
        $uploads = array();
        for ($i = 0; $i < 20; $i++) {
            $uploads[$i] = Upload::create(
                array(
                    'type_id' => rand(1, 2),
                    'path'    => preg_replace(
                        '/^.+\/uploads\//',
                        '',
                        $faker->image(
                            \Config::get('gzero-cms::upload.path')
                        )
                    ),
                    'size'    => $faker->randomNumber(),
                    'mime'    => 'image/jpeg'
                )
            );
            $uploads[$i]->contents()->attach(rand(1, 10)); // Many to many
            $uploads[$i]->contents(TRUE)->save(Content::find(rand(1, 20))); // One to many - thumb
        }

        foreach ($uploads as $upload) {
            for ($i = 0; $i < 5; $i++) {
                $upload->translations()->save(
                    new \Gzero\Models\Upload\UploadTranslation(array(
                        'lang_id'   => $i + 1,
                        'name'      => $faker->text(60),
                        'is_active' => 1
                    ))
                );
            }

        }


    }
}
