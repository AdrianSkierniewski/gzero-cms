<?php namespace Gzero\Repositories;

use Gzero\Exceptions\Exception;

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

    private
        $builder; /* Placeholder for Eloquent Query Builder */
    protected
        $model, /* Placeholder for main repository model */
        $total, /* Total records count for getPaginated() */
        $conditions = [], /* Conditions attached when getPaginated() */
        $eagerLoad = []; /* Always loaded relations */

    /**
     * {@inheritdoc}
     */
    public function getById($id)
    {
        return $this->newBuilder()->find($id);
    }

    /**
     * Ends query and returns collection
     *
     * @param int   $page
     * @param array $order
     *
     * @return mixed
     */
    public function get($page = 1, Array $order = [])
    {
        return $this->getPaginated($this->newBuilder(), $page, $order);
    }

    /**
     * Returns count from last getPaginated() query
     *
     * @return mixed
     */
    public function getLastTotal()
    {
        return $this->total;
    }

    /**
     * Clear all conditions for future queries
     *
     * @return $this
     */
    public function clearConditions()
    {
        $this->conditions[] = [];
        return $this;
    }

    //-----------------------------------------------------------------------------------------------
    // START: Query section
    //-----------------------------------------------------------------------------------------------

    /**
     * Ends query and returns collection
     *
     * @param \Illuminate\Database\Query\Builder $builder
     * @param int                                $page
     * @param array                              $order
     *
     * @return mixed
     * @throws \Gzero\Exceptions\Exception
     */
    protected final function getPaginated($builder, $page = 0, Array $order = [])
    {
        $this->prepareConditionPart($builder);
        $this->total = $builder->count();
        $this->prepareOrderPart($builder, $order);
        return $builder
            ->skip(10 * ($page - 1))
            ->take(10)
            ->get();
    }

    //-----------------------------------------------------------------------------------------------
    // END: Query section
    //-----------------------------------------------------------------------------------------------

    /**
     * Use this inheritance function to inject relation with condition
     *
     * @param array $relations
     *
     */
    protected function beforeEagerLoad(Array &$relations)
    {
        // For inheritance
    }


    /**
     * @param $builder
     * @param $order
     */
    protected function prepareOrderPart($builder, Array $order)
    {
        foreach ($order as $column => $direction) {
            $builder->orderBy($column, $direction);
        }
    }

    /**
     * @param $builder
     *
     * @throws \Gzero\Exceptions\Exception
     */
    protected function prepareConditionPart($builder)
    {
        foreach ($this->conditions as $condition) {
            if (!is_callable($condition)) {
                throw new Exception('Query condition must be callable');
            }
            $condition($builder);
        }
    }

    /**
     * Setting and returning new builder for future queries
     *
     * @param null $model
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function newBuilder($model = NULL)
    {
        if (!$model) {
            $model = $this->model;
        }
        $this->setBuilder($this->eagerLoad($model));
        return $this->getBuilder();
    }

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
     * @return \Illuminate\Database\Query\Builder
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
    protected final function eagerLoad($model)
    {
        $this->beforeEagerLoad($this->eagerLoad);
        if (!empty($this->eagerLoad)) {
            foreach ($this->eagerLoad as $key => $load) {
                if (is_callable($load)) {
                    $model = $model->with([$key => $load]);
                } else {
                    $model = $model->with($load);
                }
            }
        }
        return $model;
    }
}
