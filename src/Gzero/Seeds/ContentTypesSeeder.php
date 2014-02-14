<?php namespace Gzero\Seeds;

use Gzero\Models\Content\ContentType;
use Illuminate\Database\Seeder;


class ContentTypesSeeder extends Seeder {

    public function run()
    {
        ContentType::create(
            array('name' => 'content')
        );
        ContentType::create(
            array('name' => 'category')
        );
        ContentType::create(
            array('name' => 'product')
        );
        ContentType::create(
            array('name' => 'product_category')
        );
    }

}
