<?php namespace Gzero\Repositories\Block;

use Gzero\EloquentBaseModel\Model\Collection;
use Gzero\Models\Content\Content;
use Gzero\Models\Lang;
use Gzero\Models\Upload\UploadType;
use Gzero\Repositories\Interfaces\BaseRepository;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Interface BlockRepository
 *
 * @package    Gzero\Repositories\Coentent
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
interface BlockRepository extends BaseRepository {

    /**
     * Gets all active blocks with translation in specified lang
     *
     * @param Lang $lang Lang model
     *
     * @return mixed
     */
    public function getAllActive(Lang $lang);

    /**
     * Only public block
     *
     * @return $this
     */
    public function onlyPublic();

    /**
     * Lazy load translations
     *
     * @param Content|Collection $block Block model
     * @param Lang               $lang  Lang model
     *
     * @return mixed
     */
    public function loadTranslations($block, Lang $lang = NULL);

    /**
     * Lazy load uploads
     *
     * @param Content|Collection $block Block model
     * @param UploadType|NULL    $type  UploadType model
     *
     * @return mixed
     */
    public function loadUploads($block, UploadType $type = NULL);

}
