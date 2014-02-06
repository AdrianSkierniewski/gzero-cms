<?php namespace Gzero\Presenters;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class BlockPresenter
 *
 * @package    Gzero\Presenters
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class BlockPresenter extends BasePresenter {

    public function menu()
    {
        return $this->menu->render(
            'ul',
            function ($node) {
                return '<li>' . $node->translations->first()->title . '{sub-tree}</li>';
            },
            FALSE
        );
    }

    public function __toString()
    {
        return $this->view;
    }

} 
