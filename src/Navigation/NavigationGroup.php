<?php

namespace JulioMotol\AdminPanel\Navigation;

use Illuminate\Support\Traits\Conditionable;
use JulioMotol\AdminPanel\Navigation\Concerns\HasNavigationItems;

class NavigationGroup
{
    use Conditionable;
    use HasNavigationItems;

    public function __construct(
        public readonly string $title,
    ) {
    }

    public static function build(string $title, \Closure $callback = null): self
    {
        return tap(
            new self($title),
            fn (self $item) => $callback ? $callback($item) : null
        );
    }
}
