<?php namespace Gzero\Repositories;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class AbstractRepository
 *
 * @package    Gzero\Repositories
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
abstract class AbstractRepository {

    private $builder;
    protected $model;
    /**
     * Always loaded relations
     *
     * @var array
     */
    protected $eagerLoad = array();

    /**
     * {@inheritdoc}
     */
    public function getById($id)
    {
        return $this->eagerLoad($this->model)->find($id);
    }

    //-----------------------------------------------------------------------------------------------
    // START: Query section
    //-----------------------------------------------------------------------------------------------

    /**
     * @return $this
     */
    public function listBy()
    {
        $this->setBuilder($this->eagerLoad($this->model));
        return $this;
    }

    public function where($column, $operator = NULL, $value = NULL)
    {
        $this->getBuilder()->where($column, $operator, $value);
        return $this;
    }

    public function orWhere($column, $operator = NULL, $value = NULL)
    {
        $this->getBuilder()->orWhere($column, $operator, $value);
        return $this;
    }

    public function orderBy($column, $direction = 'asc')
    {
        $this->getBuilder()->orderBy($column, $direction = 'asc');
        return $this;
    }

    /**
     * Ends query and returns collection
     *
     * @param int $page
     * @param int $limit
     *
     * @return mixed
     */
    public function get($page = 1, $limit = 20)
    {
        return $this->getBuilder()->get();
    }

    public function count()
    {
        return $this->getBuilder()->count();
    }

    //-----------------------------------------------------------------------------------------------
    // END: Query section
    //-----------------------------------------------------------------------------------------------

    /**
     * Setting new builder for future queries
     *
     * @param $builder
     */
    protected final function setBuilder($builder)
    {
        $this->builder = $builder;
    }

    /**
     * Get Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    protected final function getBuilder()
    {
        if ($this->builder) {
            return $this->builder;
        } else {
            throw new RepositoryException('You must setBuilder first!');
        }
    }

    /**
     * Add relations to query
     *
     * @param \Illuminate\Database\Eloquent\Model
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function eagerLoad($model)
    {
        foreach ($this->eagerLoad as $load) {
            $model = $model->with($load);
        }
        return $model;
    }
}
