
<section class="auth-form d-flex justify-content-center mt-4">
    <h1>Авторизация</h1>
    <form action="{{ route('auth.login.submit') }}" method="post">
        @csrf
        <div class="row ">
            <input class="input" id="" name="login" type="text" placeholder="Логин">


            @error('login')
            <span class="invalid-feedback d-block"> {{ $message }}</span>
            @enderror
        </div>
        <div class="row col-md-12">
            <input class="input" type="password" name="password" placeholder="Пароль">

            @error('password')
            <span class="invalid-feedback d-block"> {{ $message }}</span>
            @enderror
        </div>

        <div class="row align-items-center">
            <div class="col-8">
                <div>
                    <span>Ещё нет аккаунта? <a href="{{ route('auth.register') }}"> Зарегистрируйтесь</a></span>
                </div>
                <div>
                    <a href="">Забыли пароль?</a>
                </div>
            </div>
            <button class="col-4 btn reg-btn p-2" type="submit">Войти</button>
        </div>
    </form>
</section>
