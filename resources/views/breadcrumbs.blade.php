@php($breadcrumbs = Breadcrumbs::generate())

@if ($breadcrumbs->isNotEmpty())
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                @foreach ($breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url && !$loop->last)
                        <li class="breadcrumb-item">
                            <a href="{{ $breadcrumb->url }}">
                                {{ $breadcrumb->title }}
                            </a>
                        </li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $breadcrumb->title }}
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
@endif
