<li class="nav-title">{{ $group->title }}</li>
@foreach ($group->getItems() as $item)
    @include('admin-panel::partials.sidebar-item', compact('item'))
@endforeach
