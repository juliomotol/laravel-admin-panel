<ul class="header-nav ms-auto">
    <li class="nav-item dropdown">
        <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true"
            aria-expanded="false">
            <div class="avatar avatar-md">
                <img class="avatar-img" src="{{ AdminPanel::resolveAccountAvatar() ?? asset('vendor/admin-panel/img/user.png') }}" alt="user avatar">
                {{-- TODO: add default icon --}}
            </div>
        </a>
        @if (count(AdminPanel::account()->items()) > 0 || count(AdminPanel::account()->groups()) > 0)
            <div class="dropdown-menu dropdown-menu-end pt-0">
                @foreach (AdminPanel::account()->items() as $item)
                    @include('admin-panel::partials.account-item', compact('item'))
                @endforeach
                @foreach (AdminPanel::account()->groups() as $group)
                    @include('admin-panel::partials.account-group', compact('group'))
                @endforeach
            </div>
    </li>
</ul>
