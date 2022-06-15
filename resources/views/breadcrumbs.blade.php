@if (Breadcrumbs::has())
    <div class="header-divider"></div>
    <div class="container-fluid">
        <ol class="breadcrumb my-0 ms-2">
            @foreach (Breadcrumbs::current() as $breadcrumb)
                @if ($crumb->url() && !$loop->last)
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                    </li>
                @else
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $crumb->title }}
                    </li>
                @endif
            @endforeach
        </ol>
        </nav>
    </div>
@endif
