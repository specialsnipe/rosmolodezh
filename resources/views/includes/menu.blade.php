<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand mr-2" href="{{ route('home') }}">Здесь будет лого</a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link @if(Request::route()->getName() == 'home') active @endif " aria-current="page"
                        href="{{ route('home') }}">Главная</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        О проекте
                      </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('teams') }}">Команда</a></li>
                        <li><a class="dropdown-item" href="{{ route('contacts') }}">Контакты</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{ route('about') }}">Страница о проекте</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if(Request::route()->getName() == 'tracks.index') active @endif"
                        aria-current="page" href="{{ route('tracks.index') }}">Направления</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  @if(Request::route()->getName() == 'posts.index') active @endif" aria-current="page"
                    href="{{  route('posts.index') }}">Новости</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center @if(Request::route()->getName() == 'search') active @endif " href="{{ route('search') }}" class="nav-link"> Поиск по сайту <i class="fas fa-search"></i></a>
                </li>
                @auth

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->login }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                    @if(auth()->user()->role->name == 'admin')
                        <li><a class="dropdown-item" aria-current="page" href="{{ route('admin.main.index') }}">Администрирование</a></li>
                    @else

                        <li><a class="dropdown-item" aria-current="page" href="{{ route('profile.data') }}">Персональные данные</a></li>
                        <li><a class="dropdown-item" aria-current="page" href="{{ route('profile.progress') }}">Личный кабинет</a></li>
                    @endif
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item d-flex align-items-center" aria-current="page" href="{{ route('auth.logout') }}">Выход <i class="p-2 fas fa-sign-out"></i></a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item ">
                    <a class="nav-link d-flex align-items-center  @if(Request::route()->getName() == 'auth.login') active @endif" aria-current="page" href="{{ route('auth.login') }}">Войти <i class="fas fa-sign-in"></i></a>
                </li>

                @endauth

            </ul>

        </div>
</nav>
