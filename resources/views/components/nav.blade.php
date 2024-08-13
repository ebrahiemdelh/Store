<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="{{ route('home') }}" class="brand-link"> --}}
    <a href="#" class="brand-link">
        <img src="{{ url('/') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div
        class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
        <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
        </div>
        <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
        </div>
        <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 649px;"></div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
                <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ url('') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    </div>
                    <div class="buttons d-flex justify-content-around mb-5">
                        <a href="{{ route('profile.edit') }}"
                            class="btn btn-sm btn-outline-primary text-white-40">Profile</a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-primary">Logout</button>
                        </form>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            @foreach ($items as $item)
                                <li class="nav-item">
                                    <a href="{{ route($item['route']) }}"
                                        class="nav-link {{ $item['route'] == $active ? 'active' : '' }}">
                                        <i class="{{ $item['icon'] }}"></i>
                                        <p>
                                            {{ $item['title'] }}
                                            @if (isset($item['badge']))
                                                <span
                                                    class="right badge badge-{{ $item['color'] }}">{{ ucfirst($item['badge']) }}</span>
                                            @endif
                                        </p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="height: 47.8293%; transform: translate(0px, 0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>
    </div>
    <!-- /.sidebar -->
</aside>
