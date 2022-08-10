<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.main.index')}}" class="brand-link">
        {{--            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        <span class="brand-text font-weight-light p-2">росмолодёжь</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(auth()->user()->avatar_thumbnail_path) }}" class="img-circle" alt="Миниатюра">
            </div>
            <div class="info">
                <a href="{{route('admin.users.show', auth()->user()->id)}}" class="d-block">{{ auth()->user()->first_and_last_names }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link @if(request()->routeIs('admin.users.*')) active @endif">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Пользователи
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link @if(request()->routeIs('admin.posts.*') ) active @endif">
                        <i class="nav-icon far fa-newspaper"></i>
                        <p>
                            Новости
                        </p>
                    </a>
                </li>
                <li class="flag-icon-hr">
                    <hr>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.tracks.index') }}" class="nav-link @if(request()->routeIs('admin.tracks.*') || request()->routeIs('admin.blocks.*')) active @endif">
                        <i class="nav-icon fa fa-graduation-cap"></i>
                        <p>
                            Направления
                        </p>
                    </a>
                </li>
                <li class="flag-icon-hr">
                    <hr>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.handbook.index') }}" class="nav-link @if(request()->routeIs('admin.handbook.*') ) active @endif">
                        <i class="nav-icon fa-solid far fa-address-book"></i>
                        <p>
                            Справочник
                        </p>
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.genders.index') }}" class="nav-link">--}}
{{--                        <i class="nav-icon fa fa-child"></i>--}}
{{--                        <p>--}}
{{--                            Пол--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.roles.index') }}" class="nav-link">--}}
{{--                        <i class="nav-icon fa fa-user-check"></i>--}}
{{--                        <p>--}}
{{--                            Роли--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('admin.occupations.index') }}" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-user-tie"></i>--}}

{{--                        <p>--}}
{{--                            Занятость--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                </li>--}}


                <li class="nav-item">
                    <hr>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="nav-link @if(request()->routeIs('admin.settings.*') ) active @endif">
                        <i class="nav-icon fa fa-wrench "></i>
                        <p>
                            Настройки
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>
