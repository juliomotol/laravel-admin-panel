<?php

namespace JulioMotol\AdminPanel;

use JulioMotol\AdminPanel\Commands\InstallCommand;
use JulioMotol\AdminPanel\Views\AdminPanel as AdminPanelComponent;
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
            ->hasViewComponent('admin-panel', AdminPanelComponent::class)
            ->hasAssets()
            ->hasCommands([InstallCommand::class]);
    }
}
