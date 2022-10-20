@if(session()->has('broken'))
    <div class="container p-0" >
        <div class="alert alert-success success-dismissible fade show w-100 m-0 mt-4" role="alert">
            {{ session('broken') }}
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
    </div>
    <div class="container p-0" style="margin-bottom: 400px;margin-top: 30px;">
        <a class="text-decoration-none " style="margin-left: 10px;" href="{{ route('home')}}"> Вернуться на главную</a><br>
    </div>
@elseif(session('error'))
    <div class="container p-0">
        <div class="alert alert-success danger-dismissible fade show w-100 m-0 mt-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <div class="container p-0" style="margin-bottom: 400px;margin-top: 30px;">
        <a class="text-decoration-none " style="margin-left: 10px;" href="{{ route('home')}}"> Вернуться на главную</a><br>
    </div>
@else
<section class="auth-form container d-flex justify-content-center mt-4">
    @error('error')
        <p>asdasdasd</p>
    @enderror
    <h1>Смена пароля</h1>
    <form action="{{ route('auth.forget.submit.change-password',) }}" method="post">
        @csrf
        <div class="form-group mb-3 row">
            <div class="form-floating mb-3 col-sm-12 col-md-12 col-lg-12">
                <input type="password" class="form-control" name="password" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Введите новый пароль</label>
                @error('password')
                <span class="invalid-feedback d-block"> {{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating mb-3 col-sm-12 col-md-12 col-lg-12">
                <input type="password" class="form-control" name="password_confirmation" id="floatingPassword"
                       placeholder="Password">
                <label for="floatingPassword">Повторите пароль</label>

                @error('password_confirmation')
                <span class="invalid-feedback d-block"> {{ $message }}</span>
                @enderror
            </div>
            <button class="auth-btn" type="submit">Сохранить</button>
        </div>
    </form>
</section>
@endif
