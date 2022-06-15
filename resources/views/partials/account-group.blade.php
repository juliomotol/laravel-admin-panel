@if ($group->title)
    <div class="dropdown-header bg-light py-2">
        <div class="fw-semibold">{{ $group->title }}</div>
    </div>
@else
    <div class="dropdown-divider"></div>
@endif
@foreach ($group->items() as $item)
    @include('admin-panel::partials.account-item', compact('item'))
@endforeach
