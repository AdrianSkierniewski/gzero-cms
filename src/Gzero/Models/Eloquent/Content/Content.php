<?php namespace Gzero\Models\Eloquent\Content;

use Gzero\Models\Content as ContentInterface;
use Gzero\Models\TranslatableTrait;
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
 *
 * show off @method
 *
 * @method withEntity() withEntity($lang_code = NULL) Scope method - adds all entity joins
 * @method basicOrder() basicOrder() Scope method - adds basic order by to query
 */
class Content extends \Gzero\EloquentTree\Model\Tree implements ContentInterface, PresentableInterface {

    const DIR_NAMESPACE = 'Gzero\Models\Eloquent';

    protected $with = [
        'type',
        'translations'
    ];

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
     * Return a created presenter.
     *
     * @return \Robbo\Presenter\Presenter
     */
    public function getPresenter()
    {
        return new ContentPresenter($this);
    }

    /**
     * Scope with all join`s required to order by tabular data
     *
     * @param      $query
     * @param null $lang_code
     *
     * @return mixed
     */
    public function scopeWithEntity($query, $lang_code = NULL)
    {
        return $query->select('contents.*')
            ->basicOrder()
            ->join('content_types', 'content_types.id', '=', 'contents.type_id')
            ->leftJoin('users', 'contents.user_id', '=', 'users.id')
            ->leftJoin(
                'content_translations',
                function ($join) use ($lang_code) {
                    $join->on('contents.id', '=', 'content_translations.content_id');
                    $join->where('is_current', '=', 1);
                    if ($lang_code) {
                        $join->where('lang_code', '=', $lang_code);
                    }
                }
            )
            ->groupBy('contents.id'); // We have to make sure that only one content will be returned
    }

    /**
     * Scope with basic order by
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeBasicOrder($query)
    {
        return $query->orderBy('weight', 'asc')->orderBy('published_at', 'desc');
    }

    /**
     * Returns type name for specific content
     *
     * @return mixed
     */
    public function getTypeName()
    {
        return $this->type->name;
    }

    //-----------------------------------------------------------------------------------------------
    // START: Relations section
    //-----------------------------------------------------------------------------------------------

    /**
     * Represents content relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(__NAMESPACE__ . '\ContentType');
    }

    /**
     * Represents content current translations relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(__NAMESPACE__ . '\ContentTranslation')
            ->where('is_current', '=', 1);
    }

    /**
     * Represents upload (thumb) relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thumb()
    {
        return $this->belongsTo(self::DIR_NAMESPACE . '\Upload\Upload');
    }

    /**
     * Represents menu link relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuLink()
    {
        return $this->hasMany(self::DIR_NAMESPACE . '\MenuLink\MenuLink');
    }

    /**
     * Represents uploads relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function uploads()
    {
        return $this->belongsToMany(self::DIR_NAMESPACE . '\Upload\Upload')->withTimestamps();
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

    public function getUploads()
    {

    }
}

