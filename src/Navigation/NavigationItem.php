<?php

namespace JulioMotol\AdminPanel\Navigation;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Traits\Conditionable;
use JulioMotol\AdminPanel\Navigation\Concerns\HasNavigationItems;

class NavigationItem
{
    use Conditionable;
    use HasNavigationItems;

    protected array $attributes = [];

    public ?Badge $badge = null;

    public ?string $icon_class = null;

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

    public function withBadge(Badge $badge): self
    {
        $this->badge = $badge;

        return $this;
    }

    public function withIconClass(string $icon_class): self
    {
        $this->icon_class = $icon_class;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->hasItems()
            ? array_reduce(
                $this->items,
                fn (bool $acc, self $item) => $acc ?: (Route::has($item->route) && Route::is($item->route)),
                false
            )
            : (Route::has($this->route) && Route::is($this->route));
    }

    public function route(): string
    {
        return Route::has($this->route)
            ? route($this->route, $this->parameters)
            : ($this->route ?? '#');
    }
}
