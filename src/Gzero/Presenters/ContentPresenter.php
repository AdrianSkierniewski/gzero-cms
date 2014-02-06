<?php namespace Gzero\Presenters;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class ContentPresenter
 *
 * @package    Gzero\Presenters
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class ContentPresenter extends BasePresenter {

    public $translation;

    protected function init()
    {
        $this->translation = $this->translations->first();
    }

    public function title()
    {
        return (!empty($this->translation->title)) ? $this->translation->title : 'Undefined';
    }

    public function body()
    {
        return (!empty($this->translation->body)) ? $this->translation->body : 'Undefined';
    }

    public function thumb()
    {
        return (!empty($this->thumb->path)) ? \Config::get('gzero.upload.public') . '/' . $this->thumb->path : NULL;
    }

}
