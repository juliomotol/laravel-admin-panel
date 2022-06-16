<?php

namespace JulioMotol\AdminPanel\Views\Composers;

use Composer\InstalledVersions;
use Illuminate\Contracts\View\View;

class VersionComposer
{
    public function compose(View $view)
    {
        $view->with('version_hash', md5('juliomotol/laravel-admin-panel@' . InstalledVersions::getVersion('juliomotol/laravel-admin-panel')));
    }
}
