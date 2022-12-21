@extends('admin.layouts.main')


@section('content')

    <div class="content-wrapper" style="padding-top: 1rem" xmlns="http://www.w3.org/1999/html">
        <!-- Content Header (Page header) -->
        <div class="row d-flex justify-content-between mr-3 ml-3">
            <div class="col-sm-6">
                <h1 class="">Изменение страницы "О нашем проекте"</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.about.index')}}">Управление
                            страницей "О нашем проекте"</a></li>
                    <li class="breadcrumb-item">Изменение страницы "О нашем проекте"</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        @if (session('success'))
            <div class="m-3 alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('success') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('error') }}
            </div>
        @endif
        <div class="row mr-3 ml-3 mt-5">
            <div class="col-sm-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.settings.about.update', $about->id)}}" method="post">
                            @csrf
                            @method('patch')
                            <div class="card">
                                <div class="card-header text-center">
                                    <h2>Первый блок</h2>
                                </div>
                                <div class="card-body">
                                    <div class="form-group col-12">
                                        <label for="title">Заголовок первого блока</label>
                                        <input type="text" class="form-control" id="footer_title" name="footer_title"
                                               value="{{$about->footer_title}}" placeholder="Заголовок">
                                        @error('footer_title')
                                        <div class="text-danger">{{$message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="footer_desc">Описание перого блока</label>
                                        <input type="text" class="form-control" name="footer_description"
                                               value="{{ $about->footer_description }}">
                                        @error('footer_description')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-header text-center">
                                    <h2>Второй блок</h2>
                                </div>
                                <div class="card-body d-flex">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group col-12 md-6">
                                            <label for="title">Заголовок второго блока</label>
                                            <input type="text" class="form-control" id="company_name"
                                                   name="company_name"
                                                   value="{{$about->company_name}}" placeholder="Заголовок">
                                            @error('company_name')
                                            <div class="text-danger">{{$message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12 md-6">
                                            <label for="summernote">Описание второго блока</label>
                                            <textarea id="summernote" name="company_desc">{{ $about->company_desc }}</textarea>
                                            @error('company_desc')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label for="avatar">Изображение второго блока</label>
                                        <div class="input-group row">
                                            <div class="col-sm-12 md-6 mb-3">
                                                <input type="file" id="company_image" class="company_image-input"
                                                       name="company_image"
                                                       value="Выберите">
                                                <label class="custom-file-label" for="company_image">Выберите
                                                    картинку</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <div class="col-sm-12 col-md-6 text-right mr-3">
                                                    <div class="row">
                                                        <img src="{{ asset($about->company_image_medium_path) }}"
                                                             class="col-12 rounded img-fluid img-thumbnail mb-2 user_avatar"
                                                             height="100"
                                                             alt="старый аватар пользователя">
                                                        <span
                                                            class="col-12  text-muted text-align-right">* текущее изображение</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 text-right">
                                                    <div class="row">
                                                        <img src=""
                                                             class="col-12 rounded img-fluid img-thumbnail mb-2 preview_company_image"
                                                             height="100" alt="новое изображение">
                                                        <span
                                                            class="col-12 text-muted text-align-right">* новое озображение</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-header text-center">
                                    <h2>Третий блок</h2>
                                </div>
                                <div class="card-body d-flex">
                                    <div class="col-sm-12 col-md-6">
                                        <label for="avatar">Изображение третьго блока</label>
                                        <div class="input-group row">
                                            <div class="col-sm-12 md-6 mb-3">
                                                <input type="file" id="company_advantages_image"
                                                       class="company_advantages_input" name="company_advantages_image"
                                                       value="Выберите">
                                                <label class="custom-file-label" for="company_advantages_image">Выберите
                                                    картинку</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <div class="col-sm-12 col-md-6 text-right mr-3">
                                                    <div class="row">
                                                        <img
                                                            src="{{ asset($about->company_advantages_image_medium_path) }}"
                                                            class="col-12 rounded img-fluid img-thumbnail mb-2 user_avatar"
                                                            height="100"
                                                            alt="старый аватар пользователя">
                                                        <span
                                                            class="col-12  text-muted text-align-right">* текущее изображение</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 text-right">
                                                    <div class="row">
                                                        <img src=""
                                                             class="col-12 rounded img-fluid img-thumbnail mb-2 preview_company_advantages_image"
                                                             height="100" alt="новое изображение">
                                                        <span
                                                            class="col-12 text-muted text-align-right">* новое озображение</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group col-12 ">
                                            <label for="title">Заголовок третьго блока</label>
                                            <input type="text" class="form-control" id="company_advantages_title"
                                                   name="company_advantages_title"
                                                   value="{{$about->company_advantages_title}}" placeholder="Заголовок">
                                            @error('company_advantages_title')
                                            <div class="text-danger">{{$message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Атрибуты(*меняются на странице О проекте)</label>
                                            @foreach($advantages as $advantage)
                                                <div class="d-flex justify-content-between div-line-edit mb-3">
                                                    <p class="advantage_item_{{$loop->iteration}} ml-3">
                                                        {{$advantage->description}}
                                                    </p>
                                                </div>

                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-header text-center">
                                    <h2>Четвертый блок</h2>
                                </div>
                                <div class="card-body d-flex">
                                    <div class="col-sm-12 col-md-6">
                                        <label for="avatar">Изображение четвертого блока</label>
                                        <div class="input-group row">
                                            <div class="col-sm-12 md-6 mb-3">
                                                <input type="file" id="company_grant_image"
                                                       class="company_grant_input" name="company_grant_image"
                                                       value="Выберите">
                                                <label class="custom-file-label" for="company_grant_image">Выберите
                                                    картинку</label>
                                            </div>
                                            <div class="d-flex flex-row">
                                                <div class="col-sm-12 col-md-6 text-right mr-3">
                                                    <div class="row">
                                                        <img
                                                            src="{{ asset($about->company_grant_image_medium_path) }}"
                                                            class="col-12 rounded img-fluid img-thumbnail mb-2 user_avatar"
                                                            height="100"
                                                            alt="старый аватар пользователя">
                                                        <span
                                                            class="col-12  text-muted text-align-right">* текущее изображение</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 text-right">
                                                    <div class="row">
                                                        <img src=""
                                                             class="col-12 rounded img-fluid img-thumbnail mb-2 preview_company_grant_image"
                                                             height="100" alt="новое изображение">
                                                        <span
                                                            class="col-12 text-muted text-align-right">* новое озображение</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group col-12">
                                            <label>Информация четвертого блока(* можно изменить на странице "О нашем проекте")</label>
                                            @foreach($grants as $grant)
                                                <div class="mb-3">
                                                    <h4 class="advantage_item_{{$loop->iteration}} ml-3">
                                                        {{$grant->title}}
                                                    </h4>
                                                    <p class="ml-3">
                                                        {{$grant->description}}
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-success  col-sm-12" value="Сохранить">
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@push('script')
    <script>

        let preview = (input, preview) => {
            let inputTop = document.querySelector(input);
            let previewTop = document.querySelector(preview);
            inputTop.addEventListener('change', function (event) {
                if (event.target.files.length > 0) {
                    previewTop.src = URL.createObjectURL(event.target.files[0]);
                    previewTop.style.display = "block";
                }
            })
        }
        preview('.company_image-input', ".preview_company_image");
        preview('.company_advantages_input', ".preview_company_advantages_image");
        preview('.company_grant_input', ".preview_company_grant_image");


        let divEdit = document.querySelectorAll('.div-line-edit')
        let divSave = document.querySelectorAll('.div-line-save')
        let closeInputs = function (divSave) {
            divSave.forEach(function (elem) {
               elem.classList.remove('d-flex')
               elem.classList.add('d-none')
            });
        }
        let openTexts = function (divEdit) {
            console.log(divEdit)
            divEdit.forEach(function (elem) {
                elem.classList.remove('d-none')
                elem.classList.add('d-flex')
            });
        }

        let editButtons = document.querySelectorAll('.btn-edit')
        let saveButtons = document.querySelectorAll('.btn-save')

        editButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault()
                closeInputs(divSave)
                openTexts(divEdit)
                let div = button.closest('.div-line-edit')
                div.classList.remove('d-flex')
                div.classList.add('d-none')

                let inputDiv = div.nextElementSibling
                inputDiv.classList.remove('d-none')
                inputDiv.classList.add('d-flex')
            })
        })

    </script>
@endpush
