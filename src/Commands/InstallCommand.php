<?php

namespace JulioMotol\AdminPanel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    protected $signature = 'admin-panel:install {--no-assets}';

    protected $description = 'Install all of the `juliomotol/laravel-admin-panel` resources';

    public function handle()
    {
        if (! $this->option('no-assets')) {
            $this->comment('Publishing Admin Panel Assets...');
            $this->callSilent('vendor:publish', ['--tag' => 'admin-panel-assets']);
        }

        $this->comment('Publishing Admin Panel Service Provider...');
        $this->callSilent('vendor:publish', ['--tag' => 'admin-panel-provider']);

        $this->registerAdminPanelServiceProvider();

        $this->info('Admin Panel scaffolding installed successfully.');
    }

    /**
     * Register the Admin Panel service provider in the application configuration file.
     *
     * @return void
     */
    protected function registerAdminPanelServiceProvider(): void
    {
        $namespace = Str::replaceLast('\\', '', $this->laravel->getNamespace());

        $appConfig = file_get_contents(config_path('app.php'));

        if (Str::contains($appConfig, $namespace . '\\Providers\\AdminPanelServiceProvider::class')) {
            return;
        }

        $lineEndingCount = [
            "\r\n" => substr_count($appConfig, "\r\n"),
            "\r" => substr_count($appConfig, "\r"),
            "\n" => substr_count($appConfig, "\n"),
        ];

        $eol = array_keys($lineEndingCount, max($lineEndingCount))[0];

        file_put_contents(config_path('app.php'), str_replace(
            "{$namespace}\\Providers\RouteServiceProvider::class," . $eol,
            "{$namespace}\\Providers\RouteServiceProvider::class," . $eol . "        {$namespace}\Providers\AdminPanelServiceProvider::class," . $eol,
            $appConfig
        ));

        file_put_contents(app_path('Providers\AdminPanelServiceProvider.php'), str_replace(
            "namespace App\Providers;",
            "namespace {$namespace}\Providers;",
            file_get_contents(app_path('Providers\AdminPanelServiceProvider.php'))
        ));
    }
}
