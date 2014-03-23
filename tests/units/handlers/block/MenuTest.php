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
class MenuTest extends TestCase {

    private $menuRepo;

    public function setUp()
    {
        parent::setUp();
        $this->menuRepo = Mockery::mock('Gzero\Repositories\MenuLink\MenuLinkRepository');

    }

    /** @test
     * @expectedException Gzero\Handlers\Block\BlockHandlerException
     */
    public function menu_was_not_found()
    {
        $menuHandler = new Gzero\Handlers\Block\Menu($this->menuRepo);
        $menuHandler->load((object) ['menu_id' => NULL], new Gzero\Models\Lang);
    }

    /**
     * @test
     */
    public function menu_was_found()
    {
        $this->menuRepo->shouldReceive('getById')
            ->once()
            ->shouldReceive('loadTranslations')
            ->once()
            ->shouldReceive('buildTree')
            ->once()
            ->andReturn('Block')
            ->getMock();
        $this->menuRepo->shouldReceive('getDescendants')
            ->once();
        $menuHandler = new Gzero\Handlers\Block\Menu($this->menuRepo);
        $menuHandler->load((object) ['menu_id' => 1], new Gzero\Models\Lang);
    }

}
