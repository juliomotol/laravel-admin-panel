<?php

namespace JulioMotol\AdminPanel;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use JulioMotol\AdminPanel\Facades\AdminPanel;

abstract class AdminPanelApplicationServiceProvider extends ServiceProvider implements DeferrableProvider
{
    abstract protected function build(AdminPanelManager $adminPanel): void;

    public function register()
    {
        $this->app->singleton(AdminPanelManager::class);

        AdminPanel::resolved(fn (AdminPanelManager $adminPanel) => $this->build($adminPanel));
    }

    public function provides()
    {
        return [AdminPanelManager::class];
    }
}
