<?php

namespace JulioMotol\AdminPanel;

use Composer\InstalledVersions;
use Illuminate\Support\Facades\Blade;
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
            ->hasCommands([InstallCommand::class]);
    }

    public function packageRegistered()
    {
        $this->registerBladeDirectives();
    }

    protected function registerBladeDirectives(): void
    {
        $version_hash = md5('juliomotol/laravel-admin-panel@' . InstalledVersions::getVersion('juliomotol/laravel-admin-panel'));

        Blade::directive('adminPanelStyle', function () use ($version_hash) {
            $path = asset('vendor/admin-panel/css/index.css');

            return "<link rel=\"stylesheet\" href=\"$path?$version_hash\">";
        });

        Blade::directive('adminPanelScript', function () use ($version_hash) {
            $path = asset('vendor/admin-panel/js/index.js');

            return "<script src=\"$path?$version_hash\"></script>";
        });
    }
}
