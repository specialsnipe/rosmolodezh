<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-xxl">
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
                    <a href="{{ route('search') }}" class="nav-link"> Поиск по сайту <svg style="width: 20px; height:20px" fill="rgba(0,0,0,0.4)" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 32 32" id="Glyph" version="1.1" viewBox="0 0 32 32" xml:space="preserve"><path d="M27.414,24.586l-5.077-5.077C23.386,17.928,24,16.035,24,14c0-5.514-4.486-10-10-10S4,8.486,4,14  s4.486,10,10,10c2.035,0,3.928-0.614,5.509-1.663l5.077,5.077c0.78,0.781,2.048,0.781,2.828,0  C28.195,26.633,28.195,25.367,27.414,24.586z M7,14c0-3.86,3.14-7,7-7s7,3.14,7,7s-3.14,7-7,7S7,17.86,7,14z" id="XMLID_223_"/></svg></a>
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

                        <li><a class="dropdown-item" aria-current="page" href="{{ route('profile') }}">Личный кабинет</a></li>
                    @endif
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item d-flex align-items-center" aria-current="page" href="{{ route('auth.logout') }}">Выход <i class="p-2 fas fa-sign-out"></i></a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center @if(Request::route()->getName() == 'search') active @endif " href="{{ route('search') }}" class="nav-link"> Поиск по сайту <i class="fas fa-search"></i></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link d-flex align-items-center  @if(Request::route()->getName() == 'auth.login') active @endif" aria-current="page" href="{{ route('auth.login') }}">Войти <i class="fas fa-sign-in"></i></a>
                </li>

                @endauth

            </ul>

        </div>
</nav>
