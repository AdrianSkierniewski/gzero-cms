<?php namespace Gzero\Seeds;

use Gzero\Models\Block\BlockType;
use Illuminate\Database\Seeder;

class BlockTypesSeeder extends Seeder {

    public function run()
    {
        BlockType::create(
            array('name' => 'basic')
        );
        BlockType::create(
            array('name' => 'menu')
        );
        BlockType::create(
            array('name' => 'slider')
        );
    }

}
