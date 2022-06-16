@if ($group->hasItems())
    <li class="nav-title">{{ $group->title }}</li>
    @foreach ($group->items() as $item)
        @include('admin-panel::partials.sidebar-item', compact('item'))
    @endforeach
@endif
