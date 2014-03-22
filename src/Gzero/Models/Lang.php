<?php namespace Gzero\Models;

use Gzero\EloquentBaseModel\Model\Collection;
use Illuminate\Support\Facades\DB;

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
class Lang {

    private $data;

    public function __construct($object = NULL)
    {
        $this->data = (array) $object;
    }

    public static function getAllActive()
    {
        return new Collection(self::prepareCollectionData(DB::table('langs')->where('is_enabled', '=', 1)->get()));
    }

    public static function getAll()
    {
        return new Collection(self::prepareCollectionData(DB::table('langs')->get()));
    }

    public function getAttribute($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }
        return NULL;
    }

    private static function prepareCollectionData($data)
    {
        $returnArray = [];
        foreach ($data as $value) {
            $returnArray[] = new self($value);
        }
        return $returnArray;
    }

}
