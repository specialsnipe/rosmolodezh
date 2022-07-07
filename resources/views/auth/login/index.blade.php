@extends('layouts.main')

@section('content')
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Вход на сайт</h3>
                            <form action="{{ route('auth.login.submit') }}" method="post">
                                @csrf

                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="text" id="login" class="form-control form-control-lg"
                                                   name="login" value="{{old('login')}}"/>
                                            <label class="form-label" for="login">Логин</label>

                                            @error('login')
                                            <span class="invalid-feedback d-block"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-4 pb-2">
                                        <div class="form-outline">
                                            <input type="password" id="password" class="form-control form-control-lg"
                                                   name="password"/>
                                            <label class="form-label" for="password">Пароль</label>

                                            @error('password')
                                            <span class="invalid-feedback d-block"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex align-items-center">
                                    <a href="{{ route('auth.register.show') }}" class="col-sm d-inline" > Ещё нет аккауна? Зарегистрируйтесь.  </a>
                                    <input class=" btn btn-primary btn-lg col-sm" type="submit" value="Войти"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
