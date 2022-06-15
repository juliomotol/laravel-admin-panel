<?php

namespace JulioMotol\AdminPanel\Navigation;

use Illuminate\Support\Traits\Conditionable;

class NavigationManager
{
    use Conditionable;

    protected array $items = [];
    protected array $groups = [];

    public function addNavigation(string $title, string $route, mixed $parameters = null, \Closure $callback = null): self
    {
        $this->items[] = NavigationItem::build($title, $route, $parameters, $callback);

        return $this;
    }

    public function addGroup(string $title, \Closure $callback = null): self
    {
        $this->groups[] = tap(
            new NavigationGroup($title),
            fn (NavigationGroup $group) => $callback ? $callback($group) : null
        );

        return $this;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function groups(): array
    {
        return $this->groups;
    }
}
