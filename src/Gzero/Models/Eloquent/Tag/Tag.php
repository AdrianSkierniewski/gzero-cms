<?php namespace Gzero\Models\Eloquent\Tag;

use Gzero\Models\Translatable;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class Tag
 *
 * @package    Gzero\Models\Tag
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class Tag extends \Eloquent implements Translatable {

    const DIR_NAMESPACE = 'Gzero\Models\Eloquent';

    protected $fillable = array(
        'is_active'
    );

    //-----------------------------------------------------------------------------------------------
    // START: Relations section
    //-----------------------------------------------------------------------------------------------

    /**
     * Represents tag translations relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(__NAMESPACE__ . '\TagTranslation');
    }

    /**
     * Represents contents relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contents()
    {
        return $this->belongsToMany(self::DIR_NAMESPACE . '\Content\Content')->withTimestamps();
    }

    //-----------------------------------------------------------------------------------------------
    // END: Relations section
    //-----------------------------------------------------------------------------------------------

    public function getCurrentTranslations()
    {
        // TODO: Implement getCurrentTranslations() method.
    }

    public function setCurrentTranslations()
    {
        // TODO: Implement setCurrentTranslations() method.
    }
}
