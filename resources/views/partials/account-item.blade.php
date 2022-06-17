<a class="dropdown-item {{ $item->isActive() ? 'active' : null }}" href="{{ $item->route() }}">
    <i class="icon me-2 {{  }}"></i>
    {{ $item->title }}
    @if ($item->badge)
        <span class="badge badge-sm {{ $item->badge->style->css() }} ms-2">
            {{ $item->badge->title() }}
        </span>
    @endif
</a>
