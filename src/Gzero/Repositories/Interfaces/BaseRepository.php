<?php namespace Gzero\Repositories\Interfaces;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class BaseRepository
 *
 * @package    Gzero\Repositories\Interfaces
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */

interface BaseRepository {

    /**
     * Gets entity by id
     *
     * @param $id
     *
     * @return mixed
     */
    public function getById($id);

    /**
     * @param int   $page
     * @param array $order
     *
     * @return mixed
     */
    public function get($page = 1, Array $order = []);

    /**
     * Returns count from last getPaginated() query
     *
     * @return mixed
     */
    public function getLastTotal();

    /**
     * Clear all conditions for this repository
     *
     * @return mixed
     */
    public function clearConditions();

    public function create(array $input);

    public function update(array $input);

    public function delete($id);
} 
