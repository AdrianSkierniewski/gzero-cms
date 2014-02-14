<?php namespace Gzero\Seeds;

use Gzero\Models\Block\Block;
use Gzero\Models\Block\BlockTranslation;
use Gzero\Models\Block\BlockType;
use Gzero\Models\Content\ContentTranslation;
use Gzero\Models\Lang;
use Illuminate\Database\Seeder;

class BlocksSeeder extends Seeder {


    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $type = BlockType::find(rand(1, 3)); // random type
            $this->_createFakeContent($type);
        }
    }

    /**
     * Function creates Fake Content Object with given type
     *
     * @param $type
     *
     * @return Block
     */
    private function _createFakeContent($type)
    {
        $faker         = \Faker\Factory::create();
        $block         = new Block();
        $regions       = array('header', 'footer', 'left_sidebar', 'right_sidebar');
        $content       = new ContentTranslation();
        $block->region = implode(
            '|',
            array_filter(
                $regions,
                function () {
                    return rand(0, 1);
                }
            )
        );
        if (empty($block->region)) {
            $block->region = NULL;
        }
        $block->is_active = 1;
        $block->type()->associate($type);
        if ($type->name == 'menu') {
            $block->menu_id = 1;
        }
        $block->save();
        $translation = new BlockTranslation(
            array(
                'title'     => $faker->sentence(3),
                'body'      => $faker->text(255),
                'sites'     => with($content->find(rand(1, 20)))->url, //an existing content url
                'is_active' => rand(0, 1) //an existing content url
            ));
        $translation->lang()->associate(Lang::find($faker->randomNumber(1, 5)));
        $translation->block()->associate($block);
        $translation->save();
        return $block;
    }
} 
