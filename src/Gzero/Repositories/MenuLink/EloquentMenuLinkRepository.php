<?php namespace Gzero\Repositories\MenuLink;

use Gzero\EloquentBaseModel\Model\Collection;
use Gzero\Models\Lang;
use Gzero\Models\MenuLink\MenuLink;
use Gzero\Models\MenuLink\MenuLinkTranslation;
use Gzero\Repositories\AbstractRepository;
use Gzero\Repositories\TreeRepositoryTrait;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class EloquentMenuLinkRepository
 *
 * @package    Gzero\Repositories\Coentent
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class EloquentMenuLinkRepository extends AbstractRepository implements MenuLinkRepository {

    use TreeRepositoryTrait;

    protected $translationModel;

    public function __construct(MenuLink $link, MenuLinkTranslation $translation)
    {
        $this->model            = $link;
        $this->translationModel = $translation;
    }

    public function create(array $input)
    {
        // TODO: Implement create() method.
    }

    public function update(array $input)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * Only public block
     *
     * @return $this
     */
    public function onlyPublic()
    {
        // TODO: Implement onlyPublic() method.
    }

    /**
     * Lazy load translations
     *
     * @param MenuLink|Collection $menuLink Block model
     * @param Lang                $lang     Lang model
     *
     * @return mixed
     */
    public function loadTranslations($menuLink, Lang $lang = NULL)
    {
        return $menuLink->load(
            array(
                'translations' => function ($query) use ($lang) {
                        $query->onlyActive($lang);
                    }
            )
        );
    }
}
