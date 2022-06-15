<?php

namespace JulioMotol\AdminPanel\Tests;

use JulioMotol\AdminPanel\AdminPanelServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            AdminPanelServiceProvider::class,
        ];
    }
}
