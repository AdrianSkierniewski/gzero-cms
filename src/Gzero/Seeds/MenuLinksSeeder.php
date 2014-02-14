<?php namespace Gzero\Seeds;

use Gzero\Models\Content\Content;
use Gzero\Models\Lang;
use Gzero\Models\MenuLink\MenuLink;
use Gzero\Models\MenuLink\MenuLinkTranslation;
use Illuminate\Database\Seeder;

class MenuLinksSeeder extends Seeder {

    public function run()
    {
        $faker = \Faker\Factory::create();
        // creating links
        $links = array();
        for ($i = 0; $i < 10; $i++) {
            $links[] = $this->_createFakeContent($faker);
        }
        // creating roots
        $roots = array();
        for ($i = 0; $i < 2; $i++) {
            $roots[] = $links[$i]->setAsRoot();
            // deleting roots
            unset($links[$i]);
        }
        $links = array_values($links);
        // creating level 1 parents
        $parents[] = $links[0]->setChildOf($roots[0]);
        $parents[] = $links[1]->setChildOf($roots[0]);
        $parents[] = $links[2]->setChildOf($roots[0]);
        $parents[] = $links[3]->setChildOf($roots[1]);
        $parents[] = $links[4]->setChildOf($roots[1]);
        $parents[] = $links[5]->setChildOf($roots[1]);
        for ($i = 0; $i < 6; $i++) {
            // updating level 1 parents urls
            $this->_updateUrl($links[$i]);
            // deleting level 1 parents
            unset($links[$i]);
        }
        // attaching children to the parents
        foreach ($links as $link) {
            // nesting link to the another random link
            $link->setChildOf($parents[$faker->randomNumber(0, count($parents) - 1)]);
            // updating links urls after building tree
            $this->_updateUrl($link);
        }
    }

    /**
     * Function creates Fake Content Object with given type
     *
     * @param $faker
     *
     * @return MenuLink
     */
    private function _createFakeContent($faker)
    {
        $menuLink = new MenuLink(
            array(
                'target'    => $faker->randomElement(array('_self', '_blank', '_parent', '_top')),
                'weight'    => $faker->randomNumber(1, 13),
                'is_active' => $faker->randomNumber(0, 1),
            )
        );
        $menuLink->content()->associate(Content::find($faker->randomNumber(1, Content::count())));
        $menuLink->save();

        $translation = new MenuLinkTranslation(
            array(
                'title'     => $faker->sentence(2),
                'url'       => 'link-' . $menuLink->id,
                'alt'       => $faker->sentence(2),
                'is_active' => 1
            ));
        $translation->lang()->associate(Lang::find($faker->randomNumber(1, Lang::count())));
        $translation->menuLink()->associate($menuLink);
        $translation->save();
        return $menuLink;
    }

    /**
     * Function updates links urls after nest to the another random link
     *
     * @param $link
     */
    private function _updateUrl($link)
    {
        $parents_url = NULL;
        foreach ($link->findAncestors()->get() as $parent) {
            $parents_url .= $parent->translations()->first()->url . '/';
        }
        $link_translation      = $link->translations()->first();
        $link_translation->url = rtrim($parents_url, '/');
        $link_translation->save();
    }

}
