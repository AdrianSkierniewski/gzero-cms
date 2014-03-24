<?php namespace Gzero\Repositories\Block;

use Gzero\Models\Block\Block;
use Gzero\Models\Lang;
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

    //-----------------------------------------------------------------------------------------------
    // START: Query section
    //-----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function getAllActive(Lang $lang)
    {
        $blocks = $this->eagerLoad($this->model)->whereIsActive(1)->whereNotNull('region')->get();
        return $blocks;
    }

    //-----------------------------------------------------------------------------------------------
    // END: Query section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // START: Condition section
    //-----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function onlyPublic()
    {
        $this->conditions[] = function ($q) {
            $q->where('is_current', '=', 1);
        };
        return $this;
    }

    //-----------------------------------------------------------------------------------------------
    // END: Condition section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // START: Modify section
    //-----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function create(array $input)
    {
        // TODO: Implement create() method.
    }

    /**
     * {@inheritdoc}
     */
    public function update(array $input)
    {
        // TODO: Implement update() method.
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    //-----------------------------------------------------------------------------------------------
    // END: Modify section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // START: Protected/Private section
    //-----------------------------------------------------------------------------------------------

    /**
     * Adds auto load only active translations.
     * This function is used in AbstractRepository
     *
     * @param array $relations
     */
    protected function beforeEagerLoad(Array &$relations)
    {
        $relations['translations'] = function ($q) {
            $q->onlyCurrent();
        };
    }

    //-----------------------------------------------------------------------------------------------
    // END: Protected/Private section
    //-----------------------------------------------------------------------------------------------
}
