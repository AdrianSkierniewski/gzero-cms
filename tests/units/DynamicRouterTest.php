<?php

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class DynamicRouterTest
 *
 * @package    units
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class DynamicRouterTest extends TestCase {

    protected $app;
    private $contentRepository;
    private $lang;
    private $content;
    private $dynamicRouter;

    public function setUp()
    {
        parent::setUp();
        $this->app               = Mockery::mock('Illuminate\Foundation\Application');
        $this->contentRepository = Mockery::mock('Gzero\Repositories\Content\ContentRepository');
        $this->lang              = Mockery::mock('Gzero\Models\Lang');
        $this->content           = Mockery::mock('Gzero\Models\Content\Content[getTypeName]');
        $this->dynamicRouter     = new Gzero\DynamicRouter($this->app, $this->contentRepository);
    }

    /**
     * @test
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function contentNotFound()
    {
        $this->contentRepository->shouldReceive('getByUrl')->once()->andReturnNull();
        $this->dynamicRouter->handleRequest('content-1', $this->lang);
    }

    /**
     * @test
     */
    public function contentFound()
    {
        $this->content->setAttribute('is_active', 1);
        $this->content->shouldReceive('getTypeName')
            ->once()
            ->andReturn('content');
        $this->contentRepository->shouldReceive('getByUrl')
            ->once()
            ->andReturn($this->content);
        $type = Mockery::mock('Gzero\Handlers\Content\Content');
        $this->app->shouldReceive('make')
            ->once()
            ->andReturn($type);
        $type->shouldReceive('load')
            ->once()
            ->andReturn($type)
            ->shouldReceive('render')
            ->once()
            ->andReturn('you have found me');
        $result = $this->dynamicRouter->handleRequest('content-1', $this->lang);
        $this->assertEquals('you have found me', $result);
    }

    /**
     * @test
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function incorrectContentType()
    {
        $this->content->setAttribute('is_active', 1);
        $this->content->shouldReceive('getTypeName')
            ->once()
            ->andReturn('content');
        $this->contentRepository->shouldReceive('getByUrl')
            ->once()
            ->andReturn($this->content);
        $type = Mockery::mock('Foo');
        $this->app->shouldReceive('make')
            ->once()
            ->andReturn($type);
        $this->dynamicRouter->handleRequest('content-1', $this->lang);
    }
}
