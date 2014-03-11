<?php namespace Gzero\Repositories\Interfaces;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class TreeRepository
 *
 * @package    Gzero\Repositories\Interfaces
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */

interface TreeRepository {

    /**
     * Get root for this node
     *
     * @param \Gzero\EloquentTree\Model\Tree $node
     *
     * @return mixed
     */
    public function getRoot($node);

    /**
     * Create new query for list all children for specific node.
     *
     * @param \Gzero\EloquentTree\Model\Tree $parent
     *
     * @return $this
     */
    public function getChildren($parent);

    /**
     * Create new query for list all ancestors for current node. Last node on list will be current node
     *
     * @param \Gzero\EloquentTree\Model\Tree $node
     *
     * @return mixed
     */
    public function getAncestors($node);

    /**
     * Create new query for list all descendants for specific node with this node as root node.
     *
     * @param \Gzero\EloquentTree\Model\Tree $node
     *
     * @return $this
     */
    public function getDescendants($node);

    /**
     * Get links in tree structure
     *
     * @param \Gzero\EloquentTree\Model\Tree|Collection $nodes Models
     *
     * @return mixed
     */
    public function buildTree($nodes);
} 
