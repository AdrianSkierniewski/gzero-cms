<?php namespace Gzero\Models;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Interface Translatable
 *
 * @package    Gzero\Models
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */

interface Translatable {

    /**
     * Represents content translations relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations();

}
