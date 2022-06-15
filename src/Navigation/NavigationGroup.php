<?php

namespace JulioMotol\AdminPanel\Navigation;

use Illuminate\Support\Traits\Conditionable;

class NavigationGroup
{
    use Conditionable;

    protected array $items = [];

    public function __construct(
        public readonly string $title,
    ) {
    }

    public function addNavigation(string $title, ?string $route = null, mixed $parameters = null, \Closure $callback = null): self
    {
        $this->items[] = NavigationItem::build($title, $route, $parameters, $callback);

        return $this;
    }

    public function items(): array
    {
        return $this->items;
    }
}
