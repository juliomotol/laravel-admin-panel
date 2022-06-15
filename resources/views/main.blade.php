@include('admin-panel::sidebar')
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    @include('admin-panel::header')
    <div class="body flex-grow-1 px-3">
        {{ $slot }}
    </div>
</div>
