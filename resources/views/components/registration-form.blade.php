@php
use App\Models\Gender;
use App\Models\Occupation;
use App\Models\Track;

$genders = Gender::all();
$occupations = Occupation::all();
$tracks = Track::all();
@endphp

<div class="registr-form mt-3">
    <div class="line"></div>

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
    <span class="h1 text-uppercase mb-2">Регистрация</span>
    <form action="{{ route('auth.register.store') }}" method="post" class="w-100">

        @csrf
        <div class="form-group row">
            {{-- f name --}}
            <div class="form-floating mb-3 col-sm-12  col-lg-4">
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                    id="first_name" placeholder="Фамилия" value="{{ old('first_name') }}">
                <label for="first_name">Фамилия</label>
                @error('first_name')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            {{-- s name --}}
            <div class="form-floating mb-3 col-sm-12  col-lg-4">
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror "
                    id="last_name" placeholder="Имя" value="{{ old('last_name') }}">
                <label for="last_name">Имя</label>
                @error('last_name')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            {{-- father name --}}
            <div class="form-floating mb-3 col-sm-12 col-lg-4">
                <input type="text" name="father_name" class="form-control @error('father_name') is-invalid @enderror"
                    id="father_name" placeholder="Отчество" value="{{ old('father_name') }}">
                <label for="father_name">Отчество</label>

                @error('father_name')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            {{-- Login --}}
            <div class="form-floating mb-3 col-sm-12  col-lg-6">
                <input type="text" name="login" class="form-control @error('login') is-invalid @enderror"
                    id="login" placeholder="name@example.com" value="{{ old('login') }}">
                <label for="login">Логин</label>

                @error('login')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            {{-- Email --}}
            <div class="form-floating mb-3 col-sm-12  col-lg-6">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" placeholder="E-mail" value="{{ old('email') }}">
                <label for="email">E-mail</label>

                @error('email')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            {{-- gender --}}
            <div class="form-floating mb-3 col-sm-12  col-lg-4">
                <select class="form-select @error('track_id') is-invalid @enderror" id="track_id" name="track_id"
                    aria-label="Floating label select example">
                    <option value="0" selected disabled hidden>Выберите желаемое направление</option>
                    @foreach ($tracks as $track)
                    <option value="{{ $track->id }}" @if( old('track_id')==$track->id) selected @endif>
                        {{$track->title }}</option>
                    @endforeach

                </select>
                <label for="track_id">Направление:</label>

                @error('track_id')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            {{-- ocupation --}}
            <div class="form-floating mb-3 col-sm-12  col-lg-4">
                <select name="occupation_id" class="form-select @error('occupation_id') is-invalid @enderror"
                    id="occupation_id" aria-label="Floating label select example">
                    <option value="0" selected disabled hidden>Занятость</option>
                    @foreach ($occupations as $occupation)
                    <option value="{{ $occupation->id }}" @if (old('occupation_id')==$occupation->id) selected
                        @endif>{{ $occupation->name }}</option>
                    @endforeach
                </select>
                <label for="occupation_id">Занятость:</label>

                @error('occupation_id')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            {{-- track --}}
            <div class="form-floating mb-3 col-sm-12  col-lg-4">

                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                    placeholder="+7(999)999 9999" value="{{ old('phone') }}">
                <label for="phone">Номер телефона</label>
                @error('phone')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            {{-- pass --}}
            <div class="form-floating mb-3 col-sm-12  col-lg-6">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    id="password" placeholder="Password">
                <label for="password">Пароль</label>
                @error('password')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            {{-- re pass --}}
            <div class="form-floating mb-3 col-sm-12  col-lg-6">
                <input type="password" name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                    placeholder="Password">
                <label for="password_confirmation">Повторите пароль</label>

                @error('password_confirmation')
                <span class="ml-2 text-danger"> {{ $message }}</span>
                @enderror
            </div>
            {{-- checkbox allowed --}}
            <div class="form-check-label col-sm-12  col-lg-12 ">
                <div class="col-sm-12 col-md-6">
                    <div class="checkbox">
                        <input name="allowed" class="form-check-input @error('allowed') is-invalid @enderror"
                            type="checkbox" id="checkboxNoLabel" aria-label="..." checked>
                        Согласен с <a href="#">правилами пользования</a>
                    </div>

                    @error('allowed')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button class="col-sm-12 col-md-6 col-lg-6 reg-btn" type="submit">Зарегистрироваться</button>
            </div>
            {{--
        </div> --}}
        </div>
    </form>
    <div class="line line-down"></div>
    <script>

        window.addEventListener("DOMContentLoaded", function() {
           [].forEach.call( document.querySelectorAll('#phone'), function(input) {
               var keyCode;
               function mask(event) {
                   event.keyCode && (keyCode = event.keyCode);
                   var pos = this.selectionStart;
                   if (pos < 3) event.preventDefault();
                   var matrix = "+7 (___) ___ ____",
                       i = 0,
                       def = matrix.replace(/\D/g, ""),
                       val = this.value.replace(/\D/g, ""),
                       new_value = matrix.replace(/[_\d]/g, function(a) {
                           return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                       });
                   i = new_value.indexOf("_");
                   if (i != -1) {
                       i < 5 && (i = 3);
                       new_value = new_value.slice(0, i)
                   }
                   var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                       function(a) {
                           return "\\d{1," + a.length + "}"
                       }).replace(/[+()]/g, "\\$&");
                   reg = new RegExp("^" + reg + "$");
                   if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
                   if (event.type == "blur" && this.value.length < 5)  this.value = ""
               }

               input.addEventListener("input", mask, false);
               input.addEventListener("focus", mask, false);
               input.addEventListener("blur", mask, false);
               input.addEventListener("keydown", mask, false)

           });

       });
    </script>
</div>
