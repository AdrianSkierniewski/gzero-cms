<?php namespace Gzero\Repositories\Lang;

use Gzero\Models\Lang;
use Gzero\Models\LangCollection;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class EloquentLangRepository
 *
 * @package    Gzero\Repositories\Lang
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class EloquentLangRepository implements LangRepository {

    protected $cache;
    protected $lang;
    /**
     * @var array|\Gzero\EloquentBaseModel\Model\Collection|static[]
     */
    protected $langs;

    public function __construct(Lang $lang)
    {
        $this->cache = \App::make('cache'); // Using laravel cache
        $this->lang  = $lang;
        $this->langs = $this->cache->get('langs');
        if (!$this->langs) {
            $this->langs = $this->getAllEnabled();
            $this->cache->forever('langs', $this->langs);
        }
    }

    public function getByCode($code)
    {
        return $this->langs->findByAttribute('code', $code);
    }

    public function getAll()
    {
        return $this->langs;
    }

    public function getCurrent()
    {
        return $this->getByCode(\App::getLocale());
    }

    public function getAllEnabled()
    {
        return $this->lang->getAllEnabled();
    }

}
