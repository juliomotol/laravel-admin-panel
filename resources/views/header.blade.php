<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3 d-md-none" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="icon icon-lg"></i> {{-- TODO: add icon --}}
        </button>
        @if(isset($app_logo))
            <a class="header-brand d-md-none" href="#">
                <img src="{{ $app_logo }}" alt="app logo" class="sidebar-brand-full" width="118" height="46" />
            </a>
        @endif
        @include('admin-panel::account')
    </div>
    @if (class_exists('Diglactic\Breadcrumbs\Breadcrumbs'))
        @include('admin-panel::breadcrumbs')
    @endif
</header>
