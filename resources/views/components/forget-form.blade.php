@if(session()->has('message'))
    <div class="container p-0">
        <div class="alert alert-success alert-dismissible fade show w-100 m-0 mt-4" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <div class="container p-0" style="margin-bottom: 400px;margin-top: 30px;">
        <a class="text-decoration-none " style="margin-left: 10px;" href="{{ route('home')}}"> Вернуться на главную</a><br>
    </div>
@else
    <section class="auth-form container d-flex justify-content-center mt-4">
        <h1>Восстановление пароля</h1>
        <h3>Введите Email</h3>
        <form action="{{ route('auth.forget.restore') }}" method="post">
            @csrf
            <div class="form-group mb-3 row">
                <div class="form-floating mb-3 col-sm-12 col-md-12 col-lg-12">
                    <input type="email" class="form-control" name="email" id="floatingInput"
                           placeholder="name@example.com">
                    <label for="floatingInput">Email</label>
                    @error('email')
                    <span class="invalid-feedback d-block"> {{ $message }}</span>
                    @enderror
                </div>
                <label class="form-check-label " for="flexCheckDefault">
                    <div>
                        <a class="text-decoration-none " style="margin-left: 10px;" href="{{ route('auth.login')}}">
                            <i class="fa fa-arrow-left"></i> Вернуться назад</a><br>
                    </div>
                    <button class="auth-btn" type="submit">Отправить</button>
                </label>
            </div>
        </form>
    </section>
@endif
