<?php

namespace JulioMotol\AdminPanel;

use JulioMotol\AdminPanel\Commands\InstallCommand;
use JulioMotol\AdminPanel\Views\Component;
use JulioMotol\AdminPanel\Views\Composers\VersionComposer;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AdminPanelServiceProvider extends PackageServiceProvider
{
    public function packageBooted()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->package->basePath('\..\stubs\AdminPanelServiceProvider.stub') => app_path("Providers\AdminPanelServiceProvider.php"),
            ], "{$this->package->name}-provider");
        }
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('admin-panel')
            ->hasConfigFile()
            ->hasViews()
            ->hasViewComponent('admin-panel', Component::class)
            ->hasAssets()
            ->hasCommands([InstallCommand::class])
            ->hasViewComposer(['admin-panel::styles', 'admin-panel::scripts'], VersionComposer::class);
    }
}
