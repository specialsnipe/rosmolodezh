<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-xxl">
        <a class="navbar-brand" href="index.html">Здесь будет лого</a>
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
                <li class="nav-item">
                    <a class="nav-link @if(Request::route()->getName() == 'about') active @endif " aria-current="page"
                        href="{{  route('about') }}">О проекте</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="directions.html">Направления</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="news.html">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="teams.html">Команда</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="contacts.html">Контакты</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('auth.logout') }}">Выход</a>
                </li>
                @if(auth()->user()->role->name = 'admin')
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('admin.main.index') }}">Админ панель</a>
                    </li>
                @endif
                @else
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('auth.login.show') }}">Авторизация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#registration">Регистрация</a>
                </li>
                @endauth
            </ul>
        </div>
        <!-- <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Искать здесь..." aria-label="Search">

        </form> -->


        <!-- <div class="search-box">
          <button class="btn-search"><i class="fas fa-search"></i></button>
          <input type="text" class="input-search" placeholder="Type to Search...">
        </div> -->
</nav>
