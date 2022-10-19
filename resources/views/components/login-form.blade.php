
<section class="auth-form container d-flex justify-content-center mt-4">
        <h1>Авторизация</h1>
        <form action="{{ route('auth.login.submit') }}" method="post">
        @csrf

          <div class="form-group mb-3 row">
            <div class="form-floating mb-3 col-sm-12 col-md-12 col-lg-12">
                <input type="login" class="form-control @error('login') is-invalid @enderror"
                    name="login" id="floatingInput"
                    placeholder="name@example.com" value="{{ old('login') }}">
                <label for="floatingInput">Логин</label>

              @error('login')
                <span class="invalid-feedback d-block"> {{ $message }}</span>
              @enderror

            </div>

            <div class="form-floating mb-3 col-sm-12 col-md-12 col-lg-12">
              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="floatingPassword" placeholder="Password">
              <label for="floatingPassword">Пароль</label>

              @error('password')
              <span class="invalid-feedback d-block"> {{ $message }}</span>
              @enderror

            </div>

            <label class="form-check-label " for="flexCheckDefault">
              <div>
                <span>Ещё нет аккаунта? <a href="{{ route('auth.register') }}"> Зарегистрируйтесь</a></span><br>
                <a href="">Забыли пароль?</a>
              </div>

              <button class="auth-btn" type="submit">Войти</button>
            </label>
          </form>

    </section>
