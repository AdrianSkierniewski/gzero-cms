<?php namespace Gzero\Repositories\Lang;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Interface LangRepository
 *
 * @package    Gzero\Repositories\Lang
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
interface LangRepository {

    public function getById($id);

    public function getByCode($code);

    public function getCurrent();

    public function getAll();

} 
