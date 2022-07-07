@extends('layouts.main')

@section('content')
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                            <form action="{{ route('auth.register.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="text" id="firstName" class="form-control form-control-lg"
                                                   name="first_name" value="{{old('first_name')}}"/>
                                            <label class="form-label" for="firstName">Имя</label>

                                            @error('first_name')
                                            <span class="invalid-feedback d-block"> {{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="text" id="lastName" class="form-control form-control-lg"
                                                   name="last_name" value="{{old('last_name')}}"/>
                                            <label class="form-label" for="lastName">Фамилия</label>

                                            @error('last_name')
                                            <span class="invalid-feedback d-block"> {{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline datepicker w-100">
                                            <input type="text" class="form-control form-control-lg" id="birthdayDate"
                                                   name="father_name" value="{{old('father_name')}}"/>
                                            <label for="birthdayDate" class="form-label">Отчество (если есть)</label>

                                            @error('father_name')
                                            <span class="invalid-feedback d-block"> {{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">


                                        <div class="col-6">

                                            <select class="select form-control form-control-lg" id="gender_id"
                                                    name="gender_id">
                                                <option value="0" disabled selected>Ваш пол</option>
                                                @foreach($genders as $gender)
                                                    <option value="{{ $gender->id }}"
                                                            @if(old('gender_id') == $gender->id) selected @endif>{{ $gender->name }}</option>
                                                @endforeach
                                            </select>
                                            <label class="form-label select-label" for="gender">Пол</label>
                                            @error('gender_id')
                                            <span class="invalid-feedback d-block"> {{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input type="email" id="emailAddress" class="form-control form-control-lg"
                                                   name="email" value="{{old('email')}}"/>
                                            <label class="form-label" for="emailAddress">Почта</label>

                                            @error('email')
                                            <span class="invalid-feedback d-block"> {{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input type="text" id="login" class="form-control form-control-lg"
                                                   name="login" value="{{old('login')}}"/>
                                            <label class="form-label" for="login">Логин (используется для входа)</label>

                                            @error('login')
                                            <span class="invalid-feedback d-block"> {{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input type="password" id="password" class="form-control form-control-lg"
                                                   name="password"/>
                                            <label class="form-label" for="password">Пароль</label>

                                            @error('password')
                                            <span class="invalid-feedback d-block"> {{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input type="password" id="passwordConfirmation"
                                                   class="form-control form-control-lg" name="password_confirmation"/>
                                            <label class="form-label" for="passwordConfirmation">Повтор пароля</label>

                                            @error('password_confirmation')
                                            <span class="invalid-feedback d-block"> {{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">

                                        <select class="select form-control-lg" name="occupation_id">
                                            <option value="0" disabled selected>Ваша занятость</option>
                                            @foreach($occupations as $occupation)
                                                <option value="{{ $occupation->id }}"
                                                        @if(old('occupation_id') == $occupation->id) selected @endif>{{ $occupation->name }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label select-label">Ваша занятость</label>

                                        @error('occupation_id')
                                        <span class="invalid-feedback d-block"> {{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="col-6">

                                        <select class="select form-control-lg" name="track_id">
                                            <option value="0" disabled selected>Выберите направление</option>
                                            @foreach($tracks as $track)
                                                <option value="{{ $track['id'] }}"
                                                        @if(old('track_id') == $track['id']) selected @endif>{{ $track['name'] }}</option>
                                            @endforeach
                                        </select>
                                        <label class="form-label select-label">Направление</label>

                                        @error('occupation_id')
                                        <span class="invalid-feedback d-block"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mt-4 pt-2">
                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault"
                                               name="allowed" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Согласие на обработку персональных данных
                                        </label>
                                        @error('allowed')
                                        <span class="invalid-feedback d-block"> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row d-flex align-items-center">
                                    <a href="{{ route('auth.login.show') }}" class="col-sm d-inline"> Уже
                                        зарегистрированы? Войдите. </a>
                                    <input class=" btn btn-primary btn-lg col-sm" type="submit" value="Регистрация"/>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
