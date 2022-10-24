<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.main.index')}}" class="brand-link">
        {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">--}}
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
                <a href="{{route('admin.users.show', auth()->user()->id)}}" class="d-block">{{
                    auth()->user()->first_and_last_names }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link @if(request()->routeIs('admin.users.*') && !request()->routeIs('admin.users.deleted')) active @endif">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Пользователи
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.deleted') }}"
                       class="nav-link @if(request()->routeIs('admin.users.deleted')) active @endif">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Удаленные Пользователи
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}"
                        class="nav-link @if(request()->routeIs('admin.posts.*') ) active @endif">
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
                    <a href="{{ route('admin.tracks.index') }}"
                        class="nav-link @if(request()->routeIs('admin.tracks.*') || request()->routeIs('admin.blocks.*')) active @endif">
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
                    {{-- <a href="{{ route('admin.settings.index') }}"
                        class="nav-link @if(request()->routeIs('admin.settings.*') ) active @endif">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <p>
                            Настройки
                        </p>
                    </a> --}}
                    <div class="nav-link @if(request()->routeIs('admin.settings.*') ) active @endif"
                    id="accordion1" role="tablist" aria-multiselectable="true"

                    >
                        <div class="row align-items-center d-flex justify-content-between" id="open-settings-accordion"
                            role="tab">
                            <a data-toggle="collapse" data-parent="#accordion1" aria-expanded="true"
                                aria-controls="collapseOne" @if(request()->routeIs('admin.settings.*') ) style='color: white' @endif>
                                <i class="nav-icon fa fa-cog" aria-hidden="true"></i> Настройки
                            </a>
                            <i class="fa fa-arrow-down" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div class="table-responsive collapse-settings mt-2" role="tabpanel" aria-labelledby="headingOne"
                    @if(request()->routeIs('admin.settings.*') ) @else style="display: none;" @endif>
                        <a href="{{ route('admin.settings.index') }}" class="nav-link
                        @if(request()->routeIs('admin.settings.index') ) active @endif"
                        >
                            Все настройки
                        </a>
                        <a href="{{ route('admin.settings.complexity.index') }}" class="nav-link
                        @if(request()->routeIs('admin.settings.complexity.*') ) active @endif">
                            <i class="nav-icon fa fa-th-list" aria-hidden="true"></i> Сложности
                        </a>
                        <a href="{{ route('admin.settings.slider.index') }}" class="nav-link
                        @if(request()->routeIs('admin.settings.slider.*') ) active @endif">
                            <i class="nav-icon fa fa-desktop" aria-hidden="true"></i> Слайдер
                        </a>
                        <a href="{{ route('admin.settings.information.index') }}" class="nav-link
                        @if(request()->routeIs('admin.settings.information.*') ) active @endif">
                            <i class="nav-icon fa fa-info-circle" aria-hidden="true"></i> Информация
                        </a>
                        <a href="{{ route('admin.settings.roles.index') }}" class="nav-link
                        @if(request()->routeIs('admin.settings.roles.*') ) active @endif">
                            <i class="nav-icon fa fa-user-secret"></i> Роли
                        </a>
                        <a href="{{ route('admin.settings.occupations.index') }}" class="nav-link
                        @if(request()->routeIs('admin.settings.occupations.*') ) active @endif">
                            <i class="nav-icon fa fa-briefcase"></i> Занятость
                        </a>
                        <a href="{{ route('admin.settings.genders.index') }}" class="nav-link
                        @if(request()->routeIs('admin.settings.genders.*') ) active @endif">
                            <i class="nav-icon fa fa-venus-mars"></i> Пол
                        </a>
                        <a href="{{ route('admin.settings.phrases.index') }}" class="nav-link
                        @if(request()->routeIs('admin.settings.phrases.*') ) active @endif">
                            <i class="nav-icon fas fa-trophy"></i> Фразы
                        </a>
                        <a href="{{route('admin.settings.team.index')}}" class="nav-link
                        @if(request()->routeIs('admin.settings.team.*') ) active @endif">
                           <i class="nav-icon fa fa-users"></i> Команда
                        </a>
                        <a href="{{route('admin.settings.partnership.index')}}" class="nav-link
                        @if(request()->routeIs('admin.settings.partnership.*') ) active @endif">
                           <i class="nav-icon fa fa-users"></i> Партнёрство
                        </a>
                    </div>
                </li>
                <script type="text/javascript" defer>
                    $(document).ready(function () {
                        $("#open-settings-accordion").each(function () {
                            $(this).click(function () {

                                $('.collapse-settings').slideToggle("fast");
                            })
                        });
                    });
                </script>
                {{-- <li class="nav-item">--}}
                    {{-- <a href="{{ route('admin.genders.index') }}" class="nav-link">--}}
                        {{-- <i class="nav-icon fa fa-child"></i>--}}
                        {{-- <p>--}}
                            {{-- Пол--}}
                            {{-- </p>--}}
                        {{-- </a>--}}
                    {{-- </li>--}}
                {{-- <li class="nav-item">--}}
                    {{-- <a href="{{ route('admin.roles.index') }}" class="nav-link">--}}
                        {{-- <i class="nav-icon fa fa-user-check"></i>--}}
                        {{-- <p>--}}
                            {{-- Роли--}}
                            {{-- </p>--}}
                        {{-- </a>--}}
                    {{-- </li>--}}
                {{-- <li class="nav-item">--}}
                    {{-- <a href="{{ route('admin.occupations.index') }}" class="nav-link">--}}
                        {{-- <i class="nav-icon fas fa-user-tie"></i>--}}

                        {{-- <p>--}}
                            {{-- Занятость--}}
                            {{-- </p>--}}
                        {{-- </a>--}}
                    {{-- </li>--}}


            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>
