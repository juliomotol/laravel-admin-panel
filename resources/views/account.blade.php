<ul class="header-nav ms-3">
    <li class="nav-item dropdown">
        <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true"
            aria-expanded="false">
            <div class="avatar avatar-md">
                <img class="avatar-img" src="{{ AdminPanel::resolveAccountAvatar() ?? '' }}" alt="user avatar"> {{-- TODO: add default icon --}}
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end pt-0">
            @foreach (AdminPanel::account()->getItems() as $item)
                @include('admin-panel::partials.account-item', compact('item'))
            @endforeach
            @foreach (AdminPanel::account()->getGroups() as $group)
                @include('admin-panel::partials.account-group', compact('group'))
            @endforeach
        </div>
    </li>
</ul>
