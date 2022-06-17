<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    @if ($sidebarBrand?->attributes->has('src') ?? false)
        <div class="sidebar-brand d-none d-md-flex">
            <img {{ 
                $sidebarBrand->attributes->class(['sidebar-brand-full'])
                    ->unless($headerBrand->attributes->height ?? null)
                    ->merge(['height' => 40])
            }} />
        </div>
    @endif
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
        @foreach (AdminPanel::sidebar()->items() as $item)
            @include('admin-panel::partials.sidebar-item', compact('item'))
        @endforeach
        @foreach (AdminPanel::sidebar()->groups() as $group)
            @include('admin-panel::partials.sidebar-group', compact('group'))
        @endforeach
    </ul>
</div>
