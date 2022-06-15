<?php

namespace JulioMotol\AdminPanel\Facades;

use Illuminate\Support\Facades\Facade;
use JulioMotol\AdminPanel\AdminPanelManager;

/**
 * @see \JulioMotol\AdminPanel\AdminPanel
 */
class AdminPanel extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AdminPanelManager::class;
    }
}
