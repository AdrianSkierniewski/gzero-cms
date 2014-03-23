<?php namespace Gzero\Models\Upload;

use Gzero\Models\AbstractTranslation;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class UploadTranslation
 *
 * @package    Gzero\Models\Upload
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class UploadTranslation extends AbstractTranslation {

    protected $fillable = array(
        'name'
    );

    public static $rules = array();

    //-----------------------------------------------------------------------------------------------
    // START: Relations section
    //-----------------------------------------------------------------------------------------------

    /**
     * Represents upload relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function upload()
    {
        return $this->belongsTo('Gzero\Models\Upload\Upload');
    }

    //-----------------------------------------------------------------------------------------------
    // END: Relations section
    //-----------------------------------------------------------------------------------------------

}
