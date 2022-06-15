<?php

namespace JulioMotol\AdminPanel\Navigation;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Traits\Conditionable;

class NavigationItem
{
    use Conditionable;

    protected array $dropdownItems = [];

    protected array $attributes = [];

    public ?Badge $badge = null;

    public function __construct(
        public readonly string $title,
        public readonly ?string $route = null,
        public readonly mixed $parameters = null,
    ) {
    }

    public static function build(
        string $title,
        ?string $route = null,
        mixed $parameters = null,
        \Closure $callback = null
    ): self {
        return tap(
            new self($title, $route, $parameters),
            fn (self $item) => $callback ? $callback($item) : null
        );
    }

    public function isActive(): bool
    {
        return count($this->dropdownItems)
            ? array_reduce(
                $this->dropdownItems,
                fn (bool $acc, self $item) => $acc ?: Route::has($item->route) && Route::is($item->route),
                false
            )
            : Route::has($this->route) && Route::is($this->route);
    }

    public function route(): string
    {
        return Route::has($this->route) ? route($this->route, $this->parameters) : $this->route ?? '#';
    }

    public function withBadge(Badge $badge): self
    {
        $this->badge = $badge;

        return $this;
    }

    public function addDropdownItem(string $title, ?string $route = null, mixed $parameters = null, \Closure $callback = null): self
    {
        $this->dropdownItems[] = self::build($title, $route, $parameters, $callback);

        return $this;
    }

    public function hasDropdown(): bool
    {
        return count($this->dropdownItems) > 0;
    }

    public function dropdownItems(): array
    {
        return $this->dropdownItems;
    }

    public function setAttribute(string $key, mixed $value): self
    {
        $this->attributes[$key] = $value;

        return $this;
    }

    public function attribute(string $key = null): mixed
    {
        return $key ? $this->attributes[$key] : $this->attributes;
    }
}
