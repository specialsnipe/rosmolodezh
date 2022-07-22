@php
use App\Models\Gender;
use App\Models\Occupation;
use App\Models\Track;

$genders = Gender::all();
$occupations = Occupation::all();
$tracks = Track::all();
@endphp

<section class="registr-form d-flex justify-content-center mt-4" id="registration">
    <div class="line-top"></div>
    @if (session()->has('error'))
    <div class="container mt-3 mb-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <svg class="bi bi-exclamation-triangle me-2" width="24" height="24" fill="currentColor">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
        </div>
    </div>
    @endif
    <h1>Регистрация</h1>


    <form action="{{ route('auth.register.store') }}" class="row" method="post">
        @csrf
        <div class="row mt-3 d-flex justify-content-between">
            <div class="row col-xs-12 col-md-12 col-lg-4">

                <input name="first_name" class="input " type="text" placeholder="Фамилия"
                    value="{{ old('first_name') }}">
                @error('first_name')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>

            <div class="row col-xs-12 col-md-12 col-lg-4">
                <input name="last_name" class="input col-xs-12 col-md-4 col-lg-4" type="text" placeholder="Имя"
                    value="{{ old('last_name') }}">
                @error('last_name')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            <div class="row col-xs-12 col-md-12 col-lg-4">
                <input name="father_name"
                    class="input col-xs-12 col-md-4 col-lg-4 @error('father_name') is-invalid @enderror" type="text"
                    placeholder="Отчество (если есть)" value="{{ old('father_name') }}">
                @error('father_name')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
        </div>


        <div class="row justify-content-between input-child">
            <div class="row col-xs-12 col-md-12 col-lg-6">
                <input name="login" class="input @error('login') is-invalid @enderror" id="" type="text"
                    placeholder="Логин" value="{{ old('login') }}">
                @error('login')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            <div class="row col-xs-12 col-md-12 col-lg-6">
                <input name="email" class="input col-xs-12 col-md-6 col-lg-6 @error('email') is-invalid @enderror"
                    type="email" placeholder="E-mail" value="{{ old('email') }}">
                @error('email')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="select-options">

            <div class="row col-xs-12 col-md-12 col-lg-4">
                <div class="select">
                    <select required name="gender_id">
                        <option value="0" selected disabled hidden>Укажите ваш пол</option>
                        @foreach ($genders as $gender)
                        <option value="{{ $gender->id }}" @if (old('gender_id'==$gender->id)) selected @endif>{{
                            $gender->name }}</option>
                        @endforeach
                    </select>

                    @error('gender_id')
                    <span class="ml-2 text-danger"> {{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="row col-xs-12 col-md-12 col-lg-4">
                <div class="select">
                    <select name='occupation_id' required>
                        <option value="0" selected disabled hidden>Занятость</option>
                        @foreach ($occupations as $occupation)
                        <option value="{{ $occupation->id }}" @if (old('occupation_id'==$occupation->id)) selected
                            @endif>{{ $occupation->name }}</option>
                        @endforeach
                    </select>

                    @error('occupation_id')
                    <span class="ml-2 text-danger"> {{ $message }}</span>
                    @enderror
                </div>

            </div>


            <div class="row col-xs-12 col-md-12 col-lg-4">
                <div class="select">
                    <select name='track_id' required class="test">
                        <option value="0" selected disabled hidden>Выбери желаемое направление</option>

                        @foreach ($tracks as $track)
                        <option value="{{ $track->id }}" @if (old('track_id'==$track->id)) selected @endif>{{
                            $track->title }}</option>
                        @endforeach
                    </select>

                    @error('track_id')
                    <span class="ml-2 text-danger"> {{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>

        <div class="row justify-content-between input-child">

            <div class="row col-xs-12 col-md-12 col-lg-6">
                <input class="input" type="password" name="password" placeholder="Пароль">

                @error('password')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            <div class="row col-xs-12 col-md-12 col-lg-6">
                <input class="input" type="password" name="password_confirmation" placeholder="Повторите пароль">

                @error('password_confirmation')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <label class="form-check-label" for="flexCheckDefault">
                <div class="checkbox">
                    <input class="form-check-input" name="allowed" type="checkbox" id="checkboxNoLabel" aria-label="..."
                        checked>
                    Согласен с <a href="#">правилами пользования</a>
                </div>
                @error('allowed')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <button class="btn reg-btn pl-5 pr-5 pt-2 pb-2" type="submit">Зарегистрироваться</button>
            </label>
        </div>
    </form>

    <div class="line-down"></div>
</section>
<section class="registr-form container mt-3">
    <div class="line-top"></div>
    <h1>Регистрация</h1>


    <div class="form-group mb-3 row">

        <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
            <input type="email" class="form-control" id="floatingInput" placeholder="Фамилия">
            <label for="floatingInput">Фамилия</label>
        </div>
        <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Имя">
            <label for="floatingPassword">Имя</label>
        </div>
        <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Отчество">
            <label for="floatingPassword">Отчество</label>
        </div>

        <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Логин</label>
        </div>
        <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6">
            <input type="password" class="form-control" id="floatingPassword" placeholder="E-mail">
            <label for="floatingPassword">E-mail</label>
        </div>

        <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
            <select class="form-select @error('gender_id') is-invalid @enderror" id="floatingSelect" name="gender_id" aria-label="Floating label select example">
                <option value="0" selected disabled hidden>Укажите ваш пол</option>
                @foreach ($genders as $gender)
                <option value="{{ $gender->id }}" @if (old('gender_id'==$gender->id)) selected @endif>{{
                    $gender->name }}</option>
                @endforeach

            </select>
            <label for="floatingSelect">Ваш пол:</label>

            @error('gender_id')
            <span class="ml-2 text-danger"> {{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
            <select class="form-select @error('occupation_id') is-invalid @enderror" name="'occupation_id" id="floatingSelect" aria-label="Floating label select example">
                <option value="0" selected disabled hidden>Занятость</option>
                @foreach ($occupations as $occupation)
                    <option value="{{ $occupation->id }}" @if (old('occupation_id'==$occupation->id)) selected
                        @endif>{{ $occupation->name }}</option>
                @endforeach
            </select>
            <label for="floatingSelect">Занятость:</label>

            @error('occupation_id')
            <span class="ml-2 text-danger"> {{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
            <select class="form-select @error('track_id') is-invalid @enderror" id="floatingSelect" name="track_id" aria-label="Floating label select example">
                <option value="0" selected disabled hidden>Выбери желаемое направление</option>

                @foreach ($tracks as $track)
                <option value="{{ $track->id }}" @if (old('track_id'==$track->id)) selected @endif>{{
                    $track->title }}</option>
                @endforeach
            </select>
            <label for="floatingSelect">Направление:</label>
            @error('track_id')
            <span class="ml-2 text-danger"> {{ $message }}</span>
            @enderror
        </div>

        <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"   id="floatingInput"   placeholder="Password">
            <label for="floatingInput">Пароль</label>
            @error('password')
            <span class="ml-2 text-danger"> {{ $message }}</span>
            @enderror
        </div>
        <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6">
            <input type="password" name="password_confirmation"  class="form-control @error('password_confirmation') is-invalid @enderror" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Повторите пароль</label>

            @error('password_confirmation')
            <span class="ml-2 text-danger"> {{ $message }}</span>
            @enderror
        </div>

        <label class="form-check-label col-sm-12 col-md-6 col-lg-12 " for="flexCheckDefault">
            <div class="checkbox col-sm-12 col-md-6 col-lg-6">
                <input class="form-check-input " type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
                Согласен с <a href="#">правилами пользования</a>
            </div>

            @error('allowed')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <button class="col-sm-12 col-md-6 col-lg-6 reg-btn " type="submit">Зарегистрироваться</button>
        </label>

    </div>

    <div class="line-down"></div>
</section>
