<?php namespace Gzero\Models\Upload;

use Gzero\Models\Translatable;
use Gzero\Models\TranslatableTrait;

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

    use TranslatableTrait;

    protected $fillable = array(
        'name',
        'path',
        'mime',
        'size'
    );

    /**
     * Represents upload type relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('Gzero\Models\Upload\UploadType');
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
            return $this->hasMany('Gzero\Models\Content\Content', 'thumb_id');
        }
        return $this->belongsToMany('Gzero\Models\Content\Content')->withTimestamps();
    }

    /**
     * Represents block relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function blocks()
    {
        return $this->belongsToMany('Gzero\Models\Block\Block')->withTimestamps();
    }

    /**
     * Represents tags relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('Gzero\Models\Tag\Tag');
    }

    /**
     * Represents upload translations relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany('Gzero\Models\Upload\UploadTranslation');

    }

    public function scopeWhereType($query, $typ_id)
    {
        return $query->where('type_id', '=', $typ_id);
    }

}
