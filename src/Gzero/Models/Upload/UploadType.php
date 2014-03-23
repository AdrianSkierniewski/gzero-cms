<?php namespace Gzero\Models\Upload;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class UploadType
 *
 * @package    Gzero\Models\Upload
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class UploadType extends \Eloquent {

    protected $fillable = array(
        'name'
    );

    //-----------------------------------------------------------------------------------------------
    // START: Relations section
    //-----------------------------------------------------------------------------------------------

    /**
     * Represents uploads relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uploads()
    {
        return $this->hasMany('Gzero\Models\Upload\Upload');
    }

    //-----------------------------------------------------------------------------------------------
    // END: Relations section
    //-----------------------------------------------------------------------------------------------

} 
