<?php

/**
 * This file is part of the GZERO CMS package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class BlockHandlerTest
 *
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class BlockHandlerTest extends TestCase {

    /**
     * @test
     */
    public function is_block_load_to_region()
    {
        $block          = (object) [
            'is_cacheable' => NULL,
            'region'       => 'header|footer',
            'view'         => NULL,
            'type'         => (object) ['name' => 'menu']
        ];
        $block2         = clone $block;
        $block2->region = 'footer';
        $blockType      = Mockery::mock('Foo')->shouldReceive('render')->andReturn('TestRender')->getMock();
        $app            = Mockery::mock('Illuminate\Foundation\Application')
            ->shouldReceive('make')
            ->andReturn(
                $blockType
                    ->shouldReceive('load')
                    ->andReturn($blockType)
                    ->getMock()
            )
            ->getMock();
        $blockRepo      = Mockery::mock('Gzero\Repositories\Block\BlockRepository')
            ->shouldReceive('getAllActive')
            ->once()
            ->andReturn(
                [
                    $block,
                    $block2
                ]
            )
            ->getMock();
        $blockHandler   = new \Gzero\BlockHandler($blockRepo, new Illuminate\Cache\Repository(Cache::getStore()), $app);
        $blockHandler->loadAllActive('url', new \Gzero\Models\Lang());
        $regions = \View::shared('regions');
        $this->assertEquals($regions->get('header')->first(), $block);
        $this->assertEquals($regions->get('footer')->first(), $block);
        $this->assertEquals($regions->get('footer')->last(), $block2);
    }
}
