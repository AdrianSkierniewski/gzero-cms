<?php namespace Gzero\Models;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class UploadableTrait
 *
 * @package    Gzero\Models
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */


trait UploadableTrait {

    public function scopeWithUpload($query, $type_id = NULL)
    {
        if (!$type_id) {
            return $query->with('uploads');
        }
        return $query->with(
            array(
                'uploads' => function ($query) use ($type_id) {
                        $query->whereType($type_id);
                    }
            )
        );
    }

} 
