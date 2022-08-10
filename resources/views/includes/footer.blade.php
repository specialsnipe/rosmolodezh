<div class="footer-block">
    <div class=" logo">
        <img src="images/logo.png" alt="">
    </div>

    <section>
        <div class="line-top"></div>
        <div class="links-footer">
            <a href="{{ route('home') }}">Главная</a>
            <a href="{{ route('about') }}">О проекте</a>
            <a href="{{ route('tracks.index') }}">Направления</a>
            <a href="{{  route('posts.index') }}">Новости</a>

            <a href="{{ route('teams') }}">Команда</a>
            <a href="{{ route('contacts') }}">Контакты</a>
            @auth
            <a href="{{ route('auth.logout') }}">Выход</a>
            @else
            <a href="{{ route('auth.login') }}">Авторизация</a>
            <a href="{{route('auth.register')}}">Регистрация</a>
            @endauth
        </div>
    </section>

    <div class="icons">

        <div class="icon">
            <i class="fab fa-vk"></i>
        </div>
        <div class="icon">
            <a href=""></a>    <i class="fab fa-telegram-plane"></i>
        </div>
        <div class="icon">
            <i class="fas fa-phone-alt"></i>
        </div>

    </div>
</div>
