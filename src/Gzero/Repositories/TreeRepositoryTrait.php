<?php namespace Gzero\Repositories;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class TreeTrait
 *
 * @package    Gzero\Repositories
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
trait TreeRepositoryTrait {

    public function getRoot($node)
    {
        return $this->eagerLoad($node->findRoot());
    }

    public function getChildren($parent, Array $order = [])
    {
        return $this->eagerLoad(
            $this->extendTreeQuery($parent->findChildren(), $order)
        )->get();
    }

    public function getAncestors($node, Array $order = [])
    {
        return $this->eagerLoad(
            $this->extendTreeQuery($node->findAncestors(), $order)
        )->get();
    }

    public function getDescendants($node, Array $order = [])
    {
        return $this->eagerLoad(
            $this->extendTreeQuery($node->findDescendants(), $order)
        )->get();
    }

    public function buildTree($nodes)
    {
        return $this->model->buildTree($nodes);
    }

    protected function extendTreeQuery($builder, $order)
    {
        $this->prepareConditionPart($builder);
        $this->prepareOrderPart($builder, $order);
        return $builder;
    }
} 
