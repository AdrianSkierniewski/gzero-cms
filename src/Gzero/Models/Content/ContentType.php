<?php namespace Gzero\Models\Content;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class ContentType
 *
 * @package    Gzero\Models\Content
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class ContentType extends \Eloquent {

    protected $guarded = array();

    public static $rules = array();

    //-----------------------------------------------------------------------------------------------
    // START: Relations section
    //-----------------------------------------------------------------------------------------------

    /**
     * Represents contents relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany('Gzero\Models\Content\Content');
    }

    //-----------------------------------------------------------------------------------------------
    // END: Relations section
    //-----------------------------------------------------------------------------------------------

}
