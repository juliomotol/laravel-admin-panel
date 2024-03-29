<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3 d-md-none" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="icon icon-lg cil-menu"></i> {{-- TODO: add icon --}}
        </button>
        @if (isset($headerBrand) && $headerBrand->attributes->has('src') ?? false)
            <a class="header-brand d-md-none" href="{{ $headerBrand->attributes->href ?? '#' }}">
                <img {{ 
                    $headerBrand->attributes->except('href')
                        ->unless($headerBrand->attributes->height ?? null)
                        ->merge(['height' => 40])
                }} />
            </a>
        @endif
        @include('admin-panel::account')
    </div>
    @if (class_exists('Diglactic\Breadcrumbs\Breadcrumbs'))
        @include('admin-panel::breadcrumbs')
    @endif
</header>
