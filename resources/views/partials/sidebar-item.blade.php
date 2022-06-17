<li class="{{ $item->hasItems() ? 'nav-group' . ($item->isActive() ? 'show' : null) : 'nav-item' }}">
    <a class="nav-link {{ $item->hasItems() ? 'nav-group-toggle' : null }} {{ $item->isActive() ? 'active' : null }}"
        href="{{ !$item->hasItems() ? $item->route() : '#' }}">
        @if ($item->icon_class)
            <i class="nav-icon {{ $item->icon_class }}"></i>
        @else
            <span class="nav-icon"></span>
        @endif
        {{ $item->title }}
        @if ($item->badge)
            <span class="badge badge-sm {{ $item->badge->badgeStyle->css() }} ms-auto">
                {{ $item->badge->badgeStyle->title() }}
            </span>
        @endif
    </a>
    @if ($item->hasItems())
        <ul class="nav-group-items">
            @foreach ($item->items() as $dropdownItem)
                <li class="nav-item {{ $dropdownItem->isActive() ? 'active' : null }}">
                    <a class="nav-link" href="{{ $item->route() }}">
                        <span class="nav-icon"></span>
                        {{ $item->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>
