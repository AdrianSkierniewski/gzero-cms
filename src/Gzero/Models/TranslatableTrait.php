<?php namespace Gzero\Models;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class TranslatedTrait
 *
 * @package    Gzero\Models
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */


trait TranslatableTrait {

    /**
     * With active translation in specific language or all languages
     *
     * @param      $query
     * @param Lang $lang
     *
     * @return mixed
     */
    public function scopeWithActiveTranslation($query, Lang $lang = NULL)
    {
        return $query->with(
            array(
                'translations' => function ($query) use ($lang) {
                        $query->onlyActive($lang);
                    }
            )
        );
    }

    /**
     * With all translation in specific language
     *
     * @param $query
     * @param $lang
     *
     * @return mixed
     */
    public function scopeWithAllTranslation($query, Lang $lang)
    {
        return $query->with(
            array(
                'translations' => function ($query) use ($lang) {
                        $query->lang($lang);
                    }
            )
        );
    }

} 
