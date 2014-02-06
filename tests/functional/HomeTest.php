<?php

class ExampleTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIsRender()
    {
        Route::enableFilters();
        $crawler = $this->client->request('GET', '/' . App::getLocale());
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testHaveContent()
    {
        $mock = \Mockery::mock('Gzero\Repositories\Content\ContentRepository')
            ->shouldReceive('loadTranslations')
            ->shouldReceive('loadThumb')
            ->getMock();
        $mock->shouldReceive('listBy->where->onlyPublic->get')
            ->andReturn(
                [
                    \Mockery::mock('Foo')
                        ->shouldReceive('title')->andReturn('Foobar')
                        ->shouldReceive('thumb')->andReturn('thumb_path')->getMock()
                ]
            );
        App::instance('Gzero\Repositories\Content\ContentRepository', $mock);
        Route::enableFilters();
        $crawler = $this->client->request('GET', '/' . App::getLocale());
        $this->assertEquals('Foobar', $crawler->filter('h2')->text());
    }

}
