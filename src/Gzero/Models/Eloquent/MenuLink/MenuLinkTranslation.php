<?php namespace Gzero\Models\Eloquent\MenuLink;

use Gzero\Models\Eloquent\AbstractTranslation;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class ContentTranslation
 *
 * @package    Gzero\Models\Content
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class MenuLinkTranslation extends AbstractTranslation {

    protected $fillable = array(
        'title',
        'url',
        'alt',
        'is_active'
    );

    public static $rules = array();

    //-----------------------------------------------------------------------------------------------
    // START: Relations section
    //-----------------------------------------------------------------------------------------------

    /**
     * Represents menu link relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menuLink()
    {
        return $this->belongsTo(__NAMESPACE__ . '\MenuLink');
    }

    //-----------------------------------------------------------------------------------------------
    // END: Relations section
    //-----------------------------------------------------------------------------------------------

}
