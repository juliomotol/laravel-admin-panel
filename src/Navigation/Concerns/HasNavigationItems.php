<?php

namespace JulioMotol\AdminPanel\Navigation\Concerns;

use JulioMotol\AdminPanel\Navigation\NavigationItem;

trait HasNavigationItems
{
    protected array $items = [];

    public function addItem(string $title, ?string $route = null, mixed $parameters = null, \Closure $callback = null): self
    {
        $this->items[] = NavigationItem::build($title, $route, $parameters, $callback);

        return $this;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function hasItems(): bool
    {
        return count($this->items) > 0;
    }
}
