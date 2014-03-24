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

    //-----------------------------------------------------------------------------------------------
    // START: Query section
    //--------------------------------------------------------------------------------------------

    /**
     * Get lang by code form all langs collection
     *
     * @param $code
     *
     * @return mixed
     */
    public function getByCode($code);

    /**
     * Get current lang all langs collection
     *
     * @return mixed
     */
    public function getCurrent();

    /**
     *  Only this function query DB
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Filter collection by is_enabled
     *
     * @return mixed
     */
    public function getAllEnabled();

    //-----------------------------------------------------------------------------------------------
    // END: Query section
    //-----------------------------------------------------------------------------------------------


} 
