<?php namespace Gzero\Repositories\User;

use Gzero\Models\User;
use Gzero\Repositories\AbstractRepository;
use Gzero\Repositories\TreeRepositoryTrait;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class EloquentUserRepository
 *
 * @package    Gzero\Repositories\Coentent
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class EloquentUserRepository extends AbstractRepository implements UserRepository {

    protected $eagerLoad = [];

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    //-----------------------------------------------------------------------------------------------
    // START: Query section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // END: Query section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // START: Condition section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // END: Condition section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // START: Lazy loading section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // END: Lazy loading section
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
    //-----------------------------------------------------------------------------------------------
    // END: Protected/Private section
    //-----------------------------------------------------------------------------------------------

}
