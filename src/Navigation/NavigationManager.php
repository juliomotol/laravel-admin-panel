<?php

namespace JulioMotol\AdminPanel\Navigation;

use Illuminate\Support\Traits\Conditionable;
use JulioMotol\AdminPanel\Navigation\Concerns\HasNavigationGroups;
use JulioMotol\AdminPanel\Navigation\Concerns\HasNavigationItems;

class NavigationManager
{
    use Conditionable;
    use HasNavigationItems;
    use HasNavigationGroups;
}
