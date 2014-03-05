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

    public function listChildren($parent)
    {
        $this->setBuilder($this->eagerLoad($parent->findChildren()));
        return $this;
    }

    public function listAncestors($node)
    {
        $this->setBuilder($this->eagerLoad($node->findAncestors()));
        return $this;
    }

    public function listDescendants($node)
    {
        $this->setBuilder($this->eagerLoad($node->findDescendants()));
        return $this;
    }

    public function buildTree($nodes)
    {
        return $this->model->buildTree($nodes);
    }
} 
