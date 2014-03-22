<?php namespace Gzero\Repositories\Upload;

use Gzero\Models\Upload\Upload;
use Gzero\Repositories\AbstractRepository;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class EloquentUploadRepository
 *
 * @package    Gzero\Repositories\Upload
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class EloquentUploadRepository extends AbstractRepository implements UploadRepository {

    protected $eagerLoad = ['type'];

    public function __construct(Upload $upload)
    {
        $this->model = $upload;
    }

    //-----------------------------------------------------------------------------------------------
    // START: Query section
    //-----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function getByTag($id, $page = 1, Array $order = [])
    {
        return $this->getPaginated(
            $this->newBuilder()
                ->whereHas(
                    'tags',
                    function ($q) use ($id) {
                        $q->where('tags.id', '=', $id);
                    }
                ),
            $page,
            $order
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getByContent($id, $page = 1, Array $order = [])
    {
        return $this->getPaginated(
            $this->newBuilder()
                ->select('uploads.*')
                ->join('content_upload', 'uploads.id', '=', 'content_upload.upload_id')
                ->where('content_upload.content_id', '=', $id)
            ,
            $page,
            $order
        );
    }

    //-----------------------------------------------------------------------------------------------
    // END: Query section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // START: Modify section
    //-----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function create(array $input)
    {
        // TODO: Implement create() method.
    }

    /**
     * {@inheritdoc}
     */
    public function update(array $input)
    {
        // TODO: Implement update() method.
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    //-----------------------------------------------------------------------------------------------
    // END: Modify section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // START: Protected/Private section
    //-----------------------------------------------------------------------------------------------

    /**
     * Adds auto load only active translations.
     * This function is used in AbstractRepository
     *
     * @param array $relations
     */
    protected function beforeEagerLoad(Array &$relations)
    {
        $relations['translations'] = function ($q) {
            $q->onlyCurrent();
        };
    }

    //-----------------------------------------------------------------------------------------------
    // END: Protected/Private section
    //-----------------------------------------------------------------------------------------------

}
