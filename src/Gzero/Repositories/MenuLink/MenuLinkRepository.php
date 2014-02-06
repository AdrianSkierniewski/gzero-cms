<?php namespace Gzero\Repositories\MenuLink;

use Gzero\EloquentBaseModel\Model\Collection;
use Gzero\Models\Content\Content;
use Gzero\Models\Lang;
use Gzero\Repositories\Interfaces\BaseRepository;
use Gzero\Repositories\Interfaces\TreeRepository;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Interface MenuLinkRepository
 *
 * @package    Gzero\Repositories\Coentent
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
interface MenuLinkRepository extends BaseRepository, TreeRepository {

    /**
     * Only public block
     *
     * @return $this
     */
    public function onlyPublic();

    /**
     * Lazy load translations
     *
     * @param Content|Collection $links MenuLinks model
     * @param Lang               $lang  Lang model
     *
     * @return mixed
     */
    public function loadTranslations($links, Lang $lang = NULL);

}
