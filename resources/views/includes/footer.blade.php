<div class="footer-block">
    <div class=" logo">
        <img src="images/logo.png" alt="">
    </div>

    <section>
        <div class="line-top"></div>
        <div class="links-footer">
            <a href="{{ route('home') }}">Главная</a>
            <a href="{{ route('home') }}">О проекте</a>
            <a href="">Направления</a>
            <a href="">Новости</a>

            <a href="">Команда</a>
            <a href="">Контакты</a>
            @auth
            <a href="{{ route('auth.logout') }}">Выход</a>
            @else
            <a href="{{ route('auth.login.show') }}">Авторизация</a>
            <a href="#register">Регистрация</a>
            @endauth
        </div>
    </section>

    <div class="icons">

        <div class="icon">
            <i class="fab fa-vk"></i>
        </div>
        <div class="icon">
            <i class="fab fa-telegram-plane"></i>
        </div>
        <div class="icon">
            <i class="fas fa-phone-alt"></i>
        </div>

    </div>
</div>
