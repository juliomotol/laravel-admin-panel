<?php

namespace JulioMotol\AdminPanel\Navigation;

enum BadgeStyle
{
    case PRIMARY;
    case SECONDARY;
    case INFO;
    case SUCCESS;
    case WARNING;
    case ERROR;

    public function css(): ?string
    {
        return match ($this) {
            $this::PRIMARY => 'bg-primary',
            $this::SECONDARY => 'bg-secondary',
            $this::INFO => 'bg-info',
            $this::SUCCESS => 'bg-success',
            $this::WARNING => 'bg-warning',
            $this::ERROR => 'bg-error',
            default => null,
        };
    }
}
