<?php namespace Gzero\Models;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class AbstractTranslation
 *
 * @package    Gzero\Models
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
abstract class AbstractTranslation extends \Eloquent {

    public function scopeOnlyActive($query)
    {
        return $query->whereIsActive(1);
    }

    public function scopeLang($query, Lang $lang)
    {
        return $query->whereLangId($lang->id);
    }
}