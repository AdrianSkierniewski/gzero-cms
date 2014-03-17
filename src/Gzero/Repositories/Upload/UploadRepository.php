<?php namespace Gzero\Repositories\Upload;

use Gzero\EloquentBaseModel\Model\Collection;
use Gzero\Models\Content;
use Gzero\Repositories\Interfaces\BaseRepository;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Interface UploadRepository
 *
 * @package    Gzero\Repositories\Upload
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
interface UploadRepository extends BaseRepository {

    /**
     * Gets uploads by tag
     *
     * @param int   $id
     * @param int   $page
     * @param array $order
     *
     * @return Collection
     */
    public function getByTag($id, $page = 1, Array $order = []);

    /**
     * Gets uploads by content which they belong
     *
     * @param int   $id
     * @param int   $page
     * @param array $order
     *
     * @return Collection
     */
    public function getByContent($id, $page = 1, Array $order = []);
}
