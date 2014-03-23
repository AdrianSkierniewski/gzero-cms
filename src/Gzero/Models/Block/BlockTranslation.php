<?php namespace Gzero\Models\Block;

use Gzero\Models\AbstractTranslation;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class BlockTranslation
 *
 * @package    Gzero\Models\Block
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class BlockTranslation extends AbstractTranslation {

    protected $fillable = array(
        'title',
        'body',
    );

    public static $rules = array();

    public function getBlockType()
    {
        return $this->block->type->name;
    }

    //-----------------------------------------------------------------------------------------------
    // START: Relations section
    //-----------------------------------------------------------------------------------------------

    /**
     * Represents block relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function block()
    {
        return $this->belongsTo('Gzero\Models\Block\Block');
    }

    //-----------------------------------------------------------------------------------------------
    // END: Relations section
    //-----------------------------------------------------------------------------------------------

}
