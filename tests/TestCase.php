<?php

abstract class TestCase extends Orchestra\Testbench\TestCase {

    public function setUp()
    {
        parent::setUp();
        App::register('Gzero\ServiceProvider');
    }
//    public function setUp()
//    {
//        parent::setUp();
//        $this->app->bind(
//            'Gzero\Repositories\Lang\LangRepository',
//            function () {
//                $mock = Mockery::mock('Gzero\Repositories\Lang\LangRepository'); // Mockery don't use cache
//                $mock->shouldReceive('getCurrent')
//                    ->andReturn(new \Gzero\Models\Lang(array('code' => \App::getLocale())));
//                $mock->shouldReceive('getAll')
//                    ->andReturn(
//                        new Gzero\EloquentBaseModel\Model\Collection(array(
//                            new \Gzero\Models\Lang(array(
//                                'code' =>
//                                    \App::getLocale()
//                            ))
//                        ))
//                    );
//                return $mock;
//            }
//        );
//    }

//    /**
//     * Creates the application.
//     *
//     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
//     */
//    public function createApplication()
//    {
//        $unitTesting = TRUE;
//
//        $testEnvironment = 'testing';
//        $app             = require __DIR__ . '/../../bootstrap/start.php';
//        \App::setLocale('en'); // We're setting default locale on test env
//        \Config::set('gzero.multilang.detected', TRUE);
//        return $app;
//    }

}
