<a class="dropdown-item {{ $item->isActive() ? 'active' : null }}" href="{{ $item->route() }}">
    <i class="icon me-2 {{  }}"></i>
    {{ $item->title }}
    @if ($item->badge)
        @include('admin-panel::partials.badge', ['badge' => $item->badge])
    @endif
</a>
