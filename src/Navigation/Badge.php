<?php

namespace JulioMotol\AdminPanel\Navigation;

use Closure;

class Badge
{
    public function __construct(
        public readonly string|Closure $title,
        public readonly BadgeStyle $style,
    ) {
    }

    public static function make(string|Closure $title, BadgeStyle $style): self
    {
        return new self($title, $style);
    }

    public function title(): string
    {
        return $this->title instanceof Closure ? ($this->title)() : $this->title;
    }
}
