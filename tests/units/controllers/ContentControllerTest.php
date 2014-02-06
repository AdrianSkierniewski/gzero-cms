<?php

class ContentControllerTest extends TestCase {

    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testDynamicRouter404()
    {
        $notFound          = new Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        $router            = Mockery::mock('Gzero\DynamicRouter')
            ->shouldReceive('handleRequest')
            ->once()
            ->andThrow($notFound)
            ->getMock();
        $contentRepo       = Mockery::mock('Gzero\Repositories\Content\ContentRepository');
        $contentController = new ContentController($router, $contentRepo);
        $contentController->dynamicRouter();
    }

    public function testDynamicRouterFound()
    {
        $router            = Mockery::mock('Gzero\DynamicRouter')
            ->shouldReceive('handleRequest')
            ->once()
            ->andReturn('test_view')
            ->getMock();
        $contentRepo       = Mockery::mock('Gzero\Repositories\Content\ContentRepository');
        $contentController = new ContentController($router, $contentRepo);
        $view              = $contentController->dynamicRouter();
        $this->assertEquals($view, 'test_view');
    }

}
