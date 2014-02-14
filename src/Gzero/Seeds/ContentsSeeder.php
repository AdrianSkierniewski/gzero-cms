<?php namespace Gzero\Seeds;

use Gzero\Models\Content\Content;
use Gzero\Models\Content\ContentTranslation;
use Gzero\Models\Content\ContentType;
use Gzero\Models\Lang;
use Illuminate\Database\Seeder;


class ContentsSeeder extends Seeder {

    public function run()
    {
        $faker = \Faker\Factory::create();
        // creating contents
        $pages = array();
        for ($i = 0; $i < 20; $i++) {
            if ($i < 2) {
                $type = ContentType::find(2); // category
            } else {
                $type = ContentType::find(1); // content
            }
            $pages[] = $this->_createFakeContent($faker, $type);
        }
        // creating roots
        $roots = array();
        for ($i = 0; $i < 2; $i++) {
            $roots[] = $pages[$i]->setAsRoot();
            // deleting roots
            unset($pages[$i]);
        }
        $pages = array_values($pages);
        // creating level 1 parents
        $parents[] = $pages[0]->setChildOf($roots[0]);
        $parents[] = $pages[1]->setChildOf($roots[0]);
        $parents[] = $pages[2]->setChildOf($roots[0]);
        $parents[] = $pages[3]->setChildOf($roots[1]);
        $parents[] = $pages[4]->setChildOf($roots[1]);
        $parents[] = $pages[5]->setChildOf($roots[1]);
        for ($i = 0; $i < 6; $i++) {
            // updating level 1 parents urls
            $this->_updateUrl($pages[$i]);
            // deleting level 1 parents
            unset($pages[$i]);
        }
        // attaching children to the parents
        foreach ($pages as $page) {
            // nesting page to the random category
            $page->setChildOf($parents[$faker->randomNumber(0, count($parents) - 1)]);
            // updating pages urls after building tree
            $this->_updateUrl($page);
        }
// OR
//        $content->translations()->save(
//            $translation
//        );
    }

    /**
     * Function creates Fake Content Object with given type
     *
     * @param $faker
     * @param $type
     *
     * @return Content
     */
    private function _createFakeContent($faker, $type)
    {
        $content = new Content(
            array(
                'rating'             => $faker->randomNumber(1, 10),
                'visits'             => $faker->randomNumber(1, 1232134),
                'weight'             => $faker->randomNumber(1, 20),
                'is_comment_allowed' => $faker->randomNumber(0, 1),
                'is_promoted'        => $faker->randomNumber(0, 1),
                'is_sticky'          => $faker->randomNumber(0, 1),
                'is_on_home'         => $faker->randomNumber(0, 1),
                'is_active'          => 1,
            ));
        $content->type()->associate($type);
        $content->save();

        $translation = new ContentTranslation(
            array(
                'url'       => 'content-' . $content->id,
                'title'     => $faker->sentence(3),
                'body'      => $faker->text(255),
                'is_active' => 1
            ));
        $translation->lang()->associate(Lang::find($faker->randomNumber(1, Lang::count())));
        $translation->content()->associate($content);
        $translation->save();
        return $content;
    }

    /**
     * Function updates pages urls after nest to the random category
     *
     * @param $page
     */
    private function _updateUrl($page)
    {
        $parents_url = NULL;
        foreach ($page->findAncestors()->get() as $parent) {
            $parents_url .= $parent->translations()->first()->url . '/';
        }
        $page_translation      = $page->translations()->first();
        $page_translation->url = rtrim($parents_url, '/');
        $page_translation->save();
    }

}
