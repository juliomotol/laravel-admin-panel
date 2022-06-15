<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    @if (isset($app_logo))
        <div class="sidebar-brand d-none d-md-flex">
            <img src="{{ $app_logo }}" alt="app logo" class="sidebar-brand-full" width="118" height="46" />
        </div>
    @endif
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        @foreach (AdminPanel::sidebar()->getItems() as $item)
            @include('admin-panel::partials.sidebar-item', compact('item'))
        @endforeach
        @foreach (AdminPanel::sidebar()->getGroups() as $group)
            @include('admin-panel::partials.sidebar-group', compact('group'))
        @endforeach
    </ul>
</div>
