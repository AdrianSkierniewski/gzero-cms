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
     * @param      $column
     * @param null $operator
     * @param null $value
     *
     * @return $this
     */
    public function where($column, $operator = NULL, $value = NULL);

    /**
     * @param      $column
     * @param null $operator
     * @param null $value
     *
     * @return $this
     */
    public function orWhere($column, $operator = NULL, $value = NULL);

    /**
     * @param        $column
     * @param string $direction
     *
     * @return $this
     */
    public function orderBy($column, $direction = 'asc');

    /**
     * @return $this
     */
    public function listBy();

    /**
     * Ends query and returns collection
     *
     * @param int $page
     * @param int $limit
     *
     * @return mixed
     */
    public function get($page = 1, $limit = 20);

    /**
     * Ends query and return count
     *
     * @return mixed
     */
    public function count();

    public function create(array $input);

    public function update(array $input);

    public function delete($id);
} 
