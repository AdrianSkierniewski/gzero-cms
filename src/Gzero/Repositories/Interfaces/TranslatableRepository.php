<?php namespace Gzero\Repositories\Interfaces;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class BaseRepository
 *
 * @package    Gzero\Repositories\Interfaces
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */

interface TranslatableRepository {

    /**
     * Gets entity by id
     *
     * @param $id
     *
     * @return mixed
     */
    public function getTranslationById($id);

    /**
     * @param int   $page
     * @param array $order
     *
     * @return mixed
     */
    public function getTranslations($page = 1, Array $order = []);

    public function createTranslation(array $input);

    public function updateTranslation(array $input);

    public function deleteTranslation($id);
} 
