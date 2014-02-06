<?php namespace Gzero\Models\Content;

use Gzero\Models\TranslatableInterface;
use Gzero\Models\TranslatableTrait;
use Gzero\Models\UploadableInterface;
use Gzero\Models\UploadableTrait;
use Gzero\Presenters\ContentPresenter;
use Robbo\Presenter\PresentableInterface;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class Content
 *
 * @package    Gzero\Models\Content
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class Content extends \Gzero\EloquentTree\Model\Tree implements TranslatableInterface, UploadableInterface, PresentableInterface {

    use TranslatableTrait;
    use UploadableTrait;

    protected $fillable = array(
        'rating',
        'visits',
        'weight',
        'is_on_home',
        'is_comment_allowed',
        'is_promoted',
        'is_sticky',
        'is_active',
        'options',
        'published_at',
    );

    /**
     * Represents content relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('Gzero\Models\Content\ContentType');
    }

    /**
     * Represents upload (thumb) relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thumb()
    {
        return $this->belongsTo('Gzero\Models\Upload\Upload');
    }

    /**
     * Represents menu link relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuLink()
    {
        return $this->hasMany('Gzero\Models\MenuLink\MenuLink');
    }

    /**
     * Represents uploads relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function uploads()
    {
        return $this->belongsToMany('Gzero\Models\Upload\Upload')->withTimestamps();
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
     * Represents content translations relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany('Gzero\Models\Content\ContentTranslation');
    }

    public function getTypeName()
    {
        return $this->type->name;
    }

    /**
     * Return a created presenter.
     *
     * @return \Robbo\Presenter\Presenter
     */
    public function getPresenter()
    {
        return new ContentPresenter($this);
    }

}
