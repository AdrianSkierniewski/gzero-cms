<?php namespace Gzero\Models\Block;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class BlockType
 *
 * @package    Gzero\Models\Block
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class BlockType extends \Eloquent {

    protected $guarded = array();

    public static $rules = array();

    /**
     * Represents blocks relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blocks()
    {
        return $this->hasMany('Gzero\Models\Block\Block');
    }
}
