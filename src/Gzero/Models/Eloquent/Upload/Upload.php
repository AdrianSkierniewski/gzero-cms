<?php namespace Gzero\Models\Eloquent\Upload;

use Gzero\Models\Translatable;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class Upload
 *
 * @package    Gzero\Models\Upload
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class Upload extends \Eloquent implements Translatable {

    const DIR_NAMESPACE = 'Gzero\Models\Eloquent';

    protected $fillable = array(
        'name',
        'path',
        'mime',
        'size'
    );


    public function scopeWhereType($query, $typ_id)
    {
        return $query->where('type_id', '=', $typ_id);
    }

    //-----------------------------------------------------------------------------------------------
    // START: Relations section
    //-----------------------------------------------------------------------------------------------

    /**
     * Represents upload type relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(__NAMESPACE__ . '\UploadType');
    }

    /**
     * Represents upload translations relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(__NAMESPACE__ . '\UploadTranslation')
            ->where('is_current', '=', 1);

    }

    /**
     * Represents contents relation
     *
     * @param bool $thumb Trigger for thumbs relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|\Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents($thumb = FALSE)
    {
        if ($thumb) {
            return $this->hasMany(self::DIR_NAMESPACE . '\Content\Content', 'thumb_id');
        }
        return $this->belongsToMany(self::DIR_NAMESPACE . '\Content\Content')->withTimestamps();
    }

    /**
     * Represents block relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function blocks()
    {
        return $this->belongsToMany(self::DIR_NAMESPACE . '\Block\Block')->withTimestamps();
    }

    /**
     * Represents tags relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(self::DIR_NAMESPACE . '\Tag\Tag');
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
