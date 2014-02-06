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
class ContentHandlerTest extends TestCase {

    /**
     * @test
     */
    public function buildContent()
    {
        $contentRepository = Mockery::mock('Gzero\Repositories\Content\ContentRepository')
            ->shouldIgnoreMissing();
        $content           = new Gzero\Handlers\Content\Content($contentRepository);
        $contentRepository->shouldReceive('listAncestors->get')
            ->once()
            ->andReturn(new \Gzero\EloquentBaseModel\Model\Collection(['parent content', 'dummy content']));
        $result = $content->load(new \Gzero\Models\Content\Content(), new Gzero\Models\Lang())->render();
        $this->assertEquals('dummy content', $result->offsetGet('content'));
        $this->assertEquals(['parent content'], $result->offsetGet('parents')->toArray());
    }
}
