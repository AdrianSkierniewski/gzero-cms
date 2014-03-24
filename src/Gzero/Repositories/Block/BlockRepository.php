<?php namespace Gzero\Repositories\Block;

use Gzero\Models\Lang;
use Gzero\Repositories\Interfaces\BaseRepository;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Interface BlockRepository
 *
 * @package    Gzero\Repositories\Coentent
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
interface BlockRepository extends BaseRepository {

    //-----------------------------------------------------------------------------------------------
    // START: Query section
    //--------------------------------------------------------------------------------------------

    /**
     * Gets all active blocks with translation in specified lang
     *
     * @param Lang $lang Lang model
     *
     * @return mixed
     */
    public function getAllActive(Lang $lang);

    //-----------------------------------------------------------------------------------------------
    // END: Query section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // START: Condition section
    //-----------------------------------------------------------------------------------------------

    /**
     * Only public content
     *
     * @return $this
     */
    public function onlyPublic();

    //-----------------------------------------------------------------------------------------------
    // END: Condition section
    //-----------------------------------------------------------------------------------------------

}
