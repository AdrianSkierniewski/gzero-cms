<?php namespace Gzero\Models\Eloquent\Block;

use Gzero\Models\Translatable;
use Gzero\Models\Uploadable;
use Gzero\Presenters\BlockPresenter;
use Robbo\Presenter\PresentableInterface;
use Robbo\Presenter\Robbo;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class Block
 *
 * @package    Gzero\Models\Block
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class Block extends \Eloquent implements Translatable, Uploadable, PresentableInterface {

    const DIR_NAMESPACE = 'Gzero\Models\Eloquent';

    protected $fillable = array(
        'is_active'
    );

    /**
     * Return a created presenter.
     *
     * @return \Robbo\Presenter\Presenter
     */
    public function getPresenter()
    {
        return new BlockPresenter($this);
    }

    //-----------------------------------------------------------------------------------------------
    // START: Relations section
    //-----------------------------------------------------------------------------------------------

    /**
     * Represents type relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(__NAMESPACE__ . '\BlockType');
    }

    /**
     * Represents translations relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(__NAMESPACE__ . '\BlockTranslation')
            ->where('is_current', '=', 1);
    }

    /**
     * Represents uploads relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getUploads()
    {
        return $this->belongsToMany(self::DIR_NAMESPACE . '\Upload\Upload')->withTimestamps();
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
