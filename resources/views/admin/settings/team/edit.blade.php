@extends('admin.layouts.main')


@section('content')

<div class="content-wrapper" style="padding-top: 1rem">
    <!-- Content Header (Page header) -->
    <div class="row d-flex justify-content-between mr-3 ml-3">
        <div class="col-sm-6">
            <h1 class="">Изменение члена команды: {{ $person->name }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.settings.team.index')}}">Команда</a></li>
                <li class="breadcrumb-item active">Изменение члена команды: {{ $person->name }}</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    @if (session('success'))
    <div class="m-3 alert alert-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="m-3 alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('error') }}
    </div>
    @endif
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.settings.team.update', $person->id)}}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="row">
                        <div class="col-6">

                            <div class="col-sm-12 mb-3">
                                <div class="mb-3">
                                    <label for="first_name">Имя </label>
                                    <input type="text" class="form-control " name="name" placeholder="Имя" id="name"
                                        value="{{$person->name}}">
                                    @error('name')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tg_link">Telegram username <span
                                            class="text-muted">(необязательно)</span> </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">

                                            <span class="input-group-text" id="basic-addon1">@</span>
                                        </div>
                                        <input type="text" class="form-control " name="tg_link"
                                            placeholder="userNameTelegram" id="tg_link" value="{{$person->tg_link}}">
                                    </div>
                                    @error('tg_link')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="vk_link">Ссылка вконтакте <span
                                            class="text-muted">(необязательно)</span></label>

                                    <input type="text" class="form-control " name="vk_link"
                                        placeholder="http://vk.com/id0000000" id="name" value="{{$person->vk_link}}">
                                    @error('vk_link')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email">Почта <span class="text-muted">(необязательно)</span></label>
                                    <input type="email" class="form-control " name="email"
                                        placeholder="example@stiray-granitsy.net" id="email" value="{{$person->email}}">
                                    @error('email')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-sm-12 mb-3">
                                <label for="description">Описание члена команды</label>
                                <textarea type="text" class="form-control" id="description" name="description"
                                    placeholder="Описание"> {{$person->description}} </textarea>
                                @error('description')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group row  mb-3">
                                <div class="col-sm-12">
                                    <label for="description">Превью аватара</label> <br>
                                    <img src="{{asset($person->avatarSmallPath)}}"
                                        class="col-6 rounded  img-thumbnail mb-2 preview_avatar"
                                        alt="новый аватар пользователя">
                                </div>

                                <div class="col-sm-12">

                                    <label for="avatar">Аватар пользователя</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="avatar" class="custom-file-input" name="file"
                                                value="Выберите">

                                            <label class="custom-file-label" for="avatar">Выберите
                                                картинку</label>
                                        </div>
                                    </div>
                                </div>
                                @error('file')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary w-50 ml-3 col-sm-12" value="Изменить">
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
@push('script')
<script>
    let input = document.querySelector('.custom-file-input');
        console.log(document);
        let preview = document.querySelector(".preview_avatar")
        input.addEventListener('change', function (event) {
            if (event.target.files.length > 0) {
                let src = URL.createObjectURL(event.target.files[0]);
                preview.src = src;
                preview.style.display = "block";
            }
        })

        preview.addEventListener('click', function () {
            input.click();
        });

</script>
@endpush
