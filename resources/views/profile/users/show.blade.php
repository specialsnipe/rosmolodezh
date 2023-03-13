@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')


<div class="container p-0">
    @if(session()->has('message'))
        <div class="container p-0">

            <div class="alert alert-success alert-dismissible fade show w-100 m-0 mt-4" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        </div>
    @endif
    <div class="main-container-directions">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-lg-3 d-flex flex-column upload-image">
                <img src="{{ asset($user->avatar_original_path) }}" class="img-fluid rounded mb-2 img-bordered"
                     style="object-fit: contain"
                    alt="">
            </div>

            <div class="form-content mb-4 col-xs-12 col-md-12 col-lg-9">
                <a href="{{ url()->previous() }}" class="btn btn-secondary d-block d-lg-none d-md-none d-sm-block mb-5">< Назад</a>
                <div class="text-header mb-4 d-flex align-items-center justify-content-between">
                    Личные данные "{{ $user->firstAndLastNames }}"
                    <a href="{{ url()->previous() }}" class="btn btn-secondary d-none d-lg-block d-md-block d-sm-none">< Назад</a>
                </div>

                <div class="form-group row">
                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control " >{{ $user->last_name ?? 'Не задано'  }}</span>
                        <label for="floatinginput readoly">Фамилия</label>

                    </div>
                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control">{{ $user->first_name ?? 'Не задано'  }}</span>
                        <label for="floatinginput readoly">Имя</label>

                    </div>
                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span readoly name="father_name" type="text"
                            class="form-control " id="floatingPassword"
                            placeholder="Отчество" value="{{ $user->father_name ?? 'Не задано' }}"> </span>
                        <label for="floatinginput readoly">Отчество</label>

                    </div>

                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control" >{{ $user->login ?? 'Не задано'  }}</span>
                        <label for="floatinginput readoly">Логин</label>

                    </div>
                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control">{{ $user->phone ?? 'Не задано'  }}</span>
                        <label for="floatinginput readoly">Номер телефона</label>

                    </div>

                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control ">{{ $user->age ?? 'Не задано'  }}</span>
                        <label for="floatinginput readoly">возраст</label>

                    </div>

                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4" style="display: flex; ">
                        <span style="width: 40px; display:flex; justify-content: center; align-items: center; background-color:#4886FF;
                    border-radius: 5px 0 0 5px ; color: white;">@</span>
                        <span readoly name="tg_name" style="border-radius: 0 5px 5px 0;" type="text" id="telegram"
                            class="form-control " placeholder="Telegram Username"
                            aria-label="Username" aria-describedby="basic-addon1" value="">{{ $user->tg_name ?? 'Не задано' }}</span>
                        <label for="floatingPassword" style="margin-left:40px;">Telegram Username</label>
                    </div>
                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control">{{ $user->email ?? 'Не задано'  }}</span>
                        <label for="floatinginput readoly">E-mail</label>

                    </div>

                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-4">
                        <span class="form-control"> <a href="{{ $user->vk_url ?? '#' }}">{{ $user->vk_url ?? 'Не задано' }}</a> </span>
                        <label for="floatinginput readoly">Ссылка на ВКонтакте</label>
                    </div>

                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6">
                        <span class="form-control ">{{ $user->gender ? $user->gender->name : 'Не задано' }}</span>
                        <label for="floatinginput readoly">Пол</label>
                    </div>
                    <div class="form-floating mb-3 col-sm-12 col-md-6 col-lg-6">
                        <span class="form-control ">{{ $user->occupation->name }}</span>
                        <label for="floatinginput readoly">Занятость</label>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
    <script defer>
        $('button.img-btn').on('click', function (event) {
            $('input readoly.img-btn').click()
        })
        $('input readoly.img-btn').on('input readoly', function (event) {
            $('.upload-image').trigger( "submit" );
        })
    </script>
@endpush
