<li class="{{ $item->hasDropdown() ? 'nav-group' . ($item->isActive() ? 'show' : null) : 'nav-item' }}">
    <a class="nav-link {{ $item->hasDropdown() ? 'nav-group-toggle' : null }} {{ $item->isActive() ? 'active' : null }}"
        href="{{ !$item->hasDropdown() ? $item->route() : '#' }}">
        <i class="nav-icon {{  }}"></i>
        {{ $item->title }}
        @if ($item->badge)
            <span class="badge badge-sm {{ $item->badge->badgeStyle->css() }} ms-auto">
                {{ $item->badge->badgeStyle->title() }}
            </span>
        @endif
    </a>
    @if ($item->hasDropdown())
        <ul class="nav-group-items">
            @foreach ($item->dropdownItems() as $dropdownItem)
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
