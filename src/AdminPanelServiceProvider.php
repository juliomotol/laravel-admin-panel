<?php

namespace JulioMotol\AdminPanel;

use JulioMotol\AdminPanel\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AdminPanelServiceProvider extends PackageServiceProvider
{
    public function packageBooted()
    {
        $this->publishes([
            $this->package->basePath('/../stubs/AdminPanelServiceProvider.stub') => app_path("app/Providers/AdminPanelServiceProvider.php"),
        ], "{$this->package->name}-provider");
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('admin-panel')
            ->hasConfigFile()
            ->hasViews()
            ->hasAssets()
            ->hasCommands([InstallCommand::class]);
    }
}
