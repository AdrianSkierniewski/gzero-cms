<?php namespace Gzero\Models\MenuLink;

use Gzero\Models\TranslatableInterface;
use Gzero\Models\TranslatableTrait;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class Lang
 *
 * @package    Gzero\Models
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class MenuLink extends \Gzero\EloquentTree\Model\Tree implements TranslatableInterface {

    use TranslatableTrait;

    protected $fillable = array(
        'target',
        'weight',
        'is_active'
    );

    protected $guarded = array();

    public static $rules = array();

    /**
     * Represents content relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo('Gzero\Models\Content\Content');
    }

    /**
     * Represents translations relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany('Gzero\Models\MenuLink\MenuLinkTranslation');
    }

}
