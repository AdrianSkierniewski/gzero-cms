<?php namespace Gzero\Repositories;

use Illuminate\Support\ServiceProvider;

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class RepositoryServiceProvider
 *
 * @package    Gzero\Repositories
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'Gzero\Repositories\Lang\LangRepository',
            'Gzero\Repositories\Lang\EloquentLangRepository'
        );
        $this->app->bind(
            'Gzero\Repositories\Content\ContentRepository',
            'Gzero\Repositories\Content\EloquentContentRepository'
        );
        $this->app->bind(
            'Gzero\Repositories\Block\BlockRepository',
            'Gzero\Repositories\Block\EloquentBlockRepository'
        );
        $this->app->bind(
            'Gzero\Repositories\Upload\UploadRepository',
            'Gzero\Repositories\Upload\EloquentUploadRepository'
        );
        $this->app->bind(
            'Gzero\Repositories\MenuLink\MenuLinkRepository',
            'Gzero\Repositories\MenuLink\EloquentMenuLinkRepository'
        );
        $this->app->bind(
            'Gzero\Repositories\User\UserRepository',
            'Gzero\Repositories\User\EloquentUserRepository'
        );
    }
}
