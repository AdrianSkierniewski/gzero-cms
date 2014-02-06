<?php namespace Gzero\Presenters;

use Robbo\Presenter\Presenter;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class BasePresenter
 *
 * @package    Gzero\Presenters
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class BasePresenter extends Presenter {


    public function __construct($object)
    {
        parent::__construct($object);
        $this->init();
    }

    protected function init()
    {

    }
} 
