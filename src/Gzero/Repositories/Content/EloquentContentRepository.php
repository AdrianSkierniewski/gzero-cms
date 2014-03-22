<?php namespace Gzero\Repositories\Content;

use Gzero\Models\Content\Content;
use Gzero\Models\Lang;
use Gzero\Models\Upload\UploadType;
use Gzero\Repositories\AbstractRepository;
use Gzero\Repositories\Interfaces\Collection;
use Gzero\Repositories\TreeRepositoryTrait;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class EloquentContentRepository
 *
 * @package    Gzero\Repositories\Content
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class EloquentContentRepository extends AbstractRepository implements ContentRepository {

    use TreeRepositoryTrait;

    protected $eagerLoad = ['type'];

    public function __construct(Content $content)
    {
        $this->model = $content;
    }

    //-----------------------------------------------------------------------------------------------
    // START: Query section
    //-----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function getByUrl($url, Lang $lang)
    {
        return $this->newBuilder()
            ->whereHas(
                'translations',
                function ($q) use ($url, $lang) {
                    $q->where('url', '=', $url);
                    $q->onlyActive();
                    $q->lang($lang);
                }
            )
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function getRoots(Array $order = [])
    {
        $builder = $this->newBuilder()->withEntity()->whereNull('parent_id')->where('type_id', '=', 2);
        $this->prepareOrderPart($builder, $order);
        return $builder->get();
    }

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

    //-----------------------------------------------------------------------------------------------
    // END: Query section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // START: Condition section
    //-----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function onlyPublic()
    {
        $this->conditions[] = function ($q) {
            $q->where('is_active', '=', 1);
        };
        return $this;
    }

    //-----------------------------------------------------------------------------------------------
    // END: Condition section
    //-----------------------------------------------------------------------------------------------
    //-----------------------------------------------------------------------------------------------
    // START: Lazy loading section
    //-----------------------------------------------------------------------------------------------

    /**
     * {@inheritdoc}
     */
    public function loadThumb($content)
    {
        return $content->load('thumb');
    }

    /**
     * {@inheritdoc}
     */
    public function loadUploads($content, UploadType $type = NULL)
    {
        return $content->load(
            array(
                'uploads' => function ($query) use ($type) {
                        $query->withActiveTranslations();
                        if (!empty($type)) {
                            $query->whereTypeId($type->id);
                        }
                    }
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function loadTags($content)
    {
        return $content->load(
            array(
                'tags' => function ($query) {
                        $query->withActiveTranslations();
                    }
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function loadMenuLink($content)
    {
        return $content->load(
            array(
                'menuLink' => function ($query) {
                        $query->withActiveTranslations();
                    }
            )
        );
    }

    //-----------------------------------------------------------------------------------------------
    // END: Lazy loading section
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
            $q->onlyActive();
        };
    }

    //-----------------------------------------------------------------------------------------------
    // END: Protected/Private section
    //-----------------------------------------------------------------------------------------------

}
