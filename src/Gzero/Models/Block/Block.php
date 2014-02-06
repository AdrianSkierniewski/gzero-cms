<?php namespace Gzero\Models\Block;

use Gzero\Models\TranslatableInterface;
use Gzero\Models\TranslatableTrait;
use Gzero\Models\UploadableInterface;
use Gzero\Models\UploadableTrait;
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
class Block extends \Eloquent implements TranslatableInterface, UploadableInterface, PresentableInterface {

    use TranslatableTrait;
    use UploadableTrait;

    protected $fillable = array(
        'is_active'
    );

    /**
     * Represents type relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('Gzero\Models\Block\BlockType');
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
     * Represents translations relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany('Gzero\Models\Block\BlockTranslation');
    }

    /**
     * Return a created presenter.
     *
     * @return \Robbo\Presenter\Presenter
     */
    public function getPresenter()
    {
        return new BlockPresenter($this);
    }
}
