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
    protected $langs;

    public function __construct(Lang $lang)
    {
        $this->cache = \App::make('cache'); // Using laravel cache
        $this->lang  = $lang;
        $this->langs = $this->cache->get('langs');
        if (!$this->langs) {
            $this->langs = $this->getAll();
            $this->cache->forever('langs', $this->langs);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getByCode($code)
    {
        return $this->langs->findByAttribute('code', $code);
    }

    /**
     * {@inheritdoc}
     */
    public function getAll()
    {
        return $this->lang->getAll();
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrent()
    {
        return $this->getByCode(\App::getLocale());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllEnabled()
    {
        return $this->langs->filter(
            function ($lang) {
                return $lang->is_enabled;
            }
        );
    }

}
