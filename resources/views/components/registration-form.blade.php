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
                <input name="last_name" class="input col-xs-12 col-md-4 col-lg-4" type="text"
                placeholder="Имя"  value="{{ old('last_name') }}">
                @error('last_name')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            <div class="row col-xs-12 col-md-12 col-lg-4">
                <input name="father_name"
                    class="input col-xs-12 col-md-4 col-lg-4 @error('father_name') is-invalid @enderror" type="text"
                    placeholder="Отчество (если есть)"  value="{{ old('father_name') }}">
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
                        <option value="{{ $gender->id }}" @if (old('gender_id' == $gender->id)) selected @endif>{{ $gender->name }}</option>
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
                        <option value="{{ $occupation->id }}" @if (old('occupation_id' == $occupation->id)) selected @endif>{{ $occupation->name }}</option>
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
                        <option value="{{ $track->id }}" @if (old('track_id' == $track->id)) selected @endif>{{ $track->title }}</option>
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
                <input class="input" type="password" name="password_confirmation"
                    placeholder="Повторите пароль">

                @error('password_confirmation')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <label class="form-check-label" for="flexCheckDefault">
                <div class="checkbox">
                    <input class="form-check-input" name="allowed" type="checkbox" id="checkboxNoLabel" aria-label="..." checked>
                    Согласен с <a href="#">правилами пользования</a>
                </div>
                @error('allowed')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <button class="reg-btn" type="submit">Зарегистрироваться</button>
            </label>
        </div>
    </form>

    <div class="line-down"></div>
</section>
