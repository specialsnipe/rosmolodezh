@extends('admin.layouts.main')


@section('content')

    <div class="content-wrapper" style="padding-top: 1rem">
        <!-- Content Header (Page header) -->
        <div class="row d-flex justify-content-between mr-3 ml-3">
            <div class="col-sm-6">
                <h1 class="">Добавление члена команды</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.occupations.index')}}">Занятости</a></li>
                    <li class="breadcrumb-item active">Добавление занятости</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="col-12">
            <form action="{{route('admin.settings.team.store')}}" method="post">
                @csrf
                <div class="col-sm-12 col-md-6 col-xl-4 mb-3">
                    <label for="first_name">Имя </label>
                    <input type="text" class="form-control " name="first_name" placeholder="Имя"
                           id="first_name"
                           value="{{old('first_name')}}">
                    @error('first_name')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group w-50">
                    <label for="description">Описание члена команды</label>
                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Описание"> {{old('description')}} </textarea>
                    @error('description')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-4 text-right ">
                        <div class="row">
                            <img src=""
                                 class="col-12 rounded img-fluid img-thumbnail mb-2 preview_avatar"
                                 height="100" alt="новый аватар пользователя">
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">

                        <label for="avatar">Аватар пользователя</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="avatar" class="custom-file-input" name="file"
                                       id="avatar"
                                       value="Выбирите">
                                @error('file')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                                <label class="custom-file-label" for="avatar">Выберите
                                    картинку</label>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="submit" class="btn btn-primary w-50 ml-3 col-sm-12" value="Создать">
            </form>
        </div>
    </div>


@endsection

@push('script')
    <script>
        let input = document.querySelector('.custom-file-input');
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
