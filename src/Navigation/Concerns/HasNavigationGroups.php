<?php

namespace JulioMotol\AdminPanel\Navigation\Concerns;

use JulioMotol\AdminPanel\Navigation\NavigationGroup;

trait HasNavigationGroups
{
    protected array $groups = [];

    public function addGroup(string $title, \Closure $callback = null): self
    {
        $this->groups[] = NavigationGroup::build($title, $callback);

        return $this;
    }

    public function groups(): array
    {
        return $this->groups;
    }

    public function hasGroups(): bool
    {
        return count($this->groups) > 0;
    }
}
