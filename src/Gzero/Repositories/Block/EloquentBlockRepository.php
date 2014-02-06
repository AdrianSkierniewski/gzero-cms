<?php namespace Gzero\Repositories\Block;

use Gzero\Models\Block\Block;
use Gzero\Models\Lang;
use Gzero\Models\Upload\UploadType;
use Gzero\Repositories\AbstractRepository;
use Gzero\Repositories\TreeRepositoryTrait;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class EloquentBlockRepository
 *
 * @package    Gzero\Repositories\Coentent
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class EloquentBlockRepository extends AbstractRepository implements BlockRepository {

    protected $eagerLoad = ['type'];

    public function __construct(Block $block)
    {
        $this->model = $block;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllActive(Lang $lang)
    {
        $blocks = $this->eagerLoad($this->model)->whereIsActive(1)->whereNotNull('region')->get();
        $this->loadTranslations($blocks, $lang);
        return $blocks;
    }

    //-----------------------------------------------------------------------------------------------
    // START: Query section
    //-----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function onlyPublic()
    {
        $this->getBuilder()->whereIsActive(1);
        return $this;
    }

    //-----------------------------------------------------------------------------------------------
    // END: Query section
    //-----------------------------------------------------------------------------------------------

    //-----------------------------------------------------------------------------------------------
    // START: Lazy loading section
    //-----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function loadUploads($content, Lang $lang, UploadType $type = NULL)
    {
        return $content->load(
            array(
                'uploads' => function ($query) use ($type, $lang) {
                        $query->withActiveTranslation($lang);
                        if (!empty($type)) {
                            $query->whereTypeId($type->id);
                        }
                    }
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function loadTranslations($block, Lang $lang = NULL)
    {
        return $block->load(
            array(
                'translations' => function ($query) use ($lang) {
                        $query->onlyActive($lang);
                    }
            )
        );
    }

    //-----------------------------------------------------------------------------------------------
    // END: Lazy loading section
    //-----------------------------------------------------------------------------------------------

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

}
