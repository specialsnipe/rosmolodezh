@extends('admin.layouts.main')


@section('content')

    <div class="content-wrapper" style="padding-top: 1rem" xmlns="http://www.w3.org/1999/html">
        <!-- Content Header (Page header) -->
        <div class="row d-flex justify-content-between mr-3 ml-3">
            <div class="col-sm-6">
                <h1 class="">Управление страницей "О нашем проекте"</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.settings.about.index')}}">Управление
                            страницей "О нашем проекте"</a></li>
                    <li class="breadcrumb-item">Управление страницей "О нашем проекте"</li>
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
        <div class="row mr-3 ml-3 mt-2">
            <div class="col-sm-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Первый блок</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group col-12">
                                    {{$about->footer_title}}
                                </div>
                                <div class="form-group col-12">
                                    {{ $about->footer_description }}
                                </div>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-header text-center">
                                <h4>Второй блок</h4>
                            </div>
                            <div class="card-body d-flex">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group col-12 md-6">
                                        {{$about->company_name}}
                                    </div>
                                    <div class="form-group col-12 md-6">{{ $about->company_desc }}
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="input-group row">
                                        <div class="d-flex flex-row">
                                            <div class="col-sm-12 col-md-12 text-right mr-3">
                                                <div class="row">
                                                    <img src="{{ asset($about->company_image_big) }}"
                                                         class="col-12 rounded img-fluid img-thumbnail mb-2 user_avatar h"
                                                         alt="Первая картинка">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-header text-center">
                                <h4>Третий блок</h4>
                            </div>
                            <div class="card-body d-flex">
                                <div class="col-sm-12 col-md-6">
                                    <div class="input-group row">
                                        <div class="d-flex flex-row">
                                            <div class="col-sm-12 col-md-12 text-right mr-3">
                                                <div class="row">
                                                    <img
                                                        src="{{ asset($about->company_advantages_image_big) }}"
                                                        class="col-12 rounded img-fluid img-thumbnail mb-2 user_avatar"
                                                        alt="Второе изображение">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group col-12 ">
                                        {{$about->company_advantages_title}}
                                    </div>
                                    <div class="form-group col-12">
                                        @foreach($advantages as $advantage)
                                            <div class=" d-flex justify-content-between div-line-edit mb-3">
                                                <p class="advantage_item_{{$loop->iteration}} ml-3">
                                                    {{$advantage->description}}
                                                </p>
                                                <div class="d-flex align-items-start">
                                                    <button class="btn btn-success btn-edit ml-3">
                                                        <i class="fa fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#modalAdvantage{{$advantage->id}}"><i
                                                            class="fa fa-trash"></i>
                                                    </button>
                                                    <x-modal name="Вы уверены что хотите удалить?" type="delete"
                                                             action="{{ route('admin.settings.about-advantages.destroy', [$advantage->id]) }}"
                                                             targetid="modalAdvantage{{$advantage->id }}">
                                                    </x-modal>
                                                </div>
                                            </div>

                                            <form class="d-none justify-content-between div-line-save mb-3"
                                                  action="{{route('admin.settings.about-advantages.update', $advantage->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('put')
                                                <input name="description"
                                                       type="text"
                                                       class="form-control advantage_item_{{$loop->iteration}} ml-3"
                                                       value="{{$advantage->description}}">
                                                <button class="btn btn-success btn-save ml-3">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <div class="btn btn-primary btn-cancel">
                                                    <i class="fa fa-minus"></i>
                                                </div>
                                            </form>
                                        @endforeach
                                        <div>
                                            <button class="btn btn-success btn-add">
                                                добавить элемент
                                            </button>
                                            <form class="d-none justify-content-between div-line-input mb-3"
                                                  action="{{route('admin.settings.about-advantages.store')}}"
                                                  method="post">
                                                @csrf
                                                @method('post')
                                                <input name="description"
                                                       type="text"
                                                       class="form-control ml-3">
                                                <button class="btn btn-success btn-save">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <div class="btn btn-primary btn-cancel">
                                                    <i class="fa fa-minus"></i>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-header text-center">
                                <h4>Четвертый блок</h4>
                            </div>
                            <div class="card-body d-flex">
                                <div class="col-sm-12 col-md-6">
                                    <div class="input-group row">

                                        <div class="d-flex flex-row">
                                            <div class="col-sm-12 col-md-12 text-right mr-3">
                                                <div class="row">
                                                    <img
                                                        src="{{ asset($about->company_grant_image_big) }}"
                                                        class="col-12 rounded img-fluid img-thumbnail mb-2 user_avatar"
                                                        alt="Третье изображение">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">

                                    <div class="form-group col-12">
                                        @foreach($grants as $grant)
                                            <div class="d-flex justify-content-between div-line-edit mb-3">
                                                <div class="d-flex flex-column">
                                                    <h4>{{$grant->title}}</h4>
                                                    <p class="advantage_item_{{$loop->iteration}} ml-3">
                                                        {{$grant->description}}
                                                    </p>
                                                </div>
                                                <div class="d-flex align-items-start">
                                                    <button class="btn btn-success btn-edit">
                                                        <i class="fa fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#modalAdvantage{{$grant->id}}"><i
                                                            class="fa fa-trash"></i>
                                                    </button>
                                                    <x-modal name="Вы уверены что хотите удалить?" type="delete"
                                                             action="{{ route('admin.settings.about-grants.destroy', [$grant->id]) }}"
                                                             targetid="modalAdvantage{{$grant->id }}">
                                                    </x-modal>
                                                </div>
                                            </div>

                                            <form class="d-none justify-content-between div-line-save mb-3"
                                                  action="{{route('admin.settings.about-grants.update', $grant->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('put')
                                                <div class="d-flex flex-column w-100">
                                                    <input name="title"
                                                           type="text"
                                                           class="form-control advantage_item_{{$loop->iteration}} ml-3"
                                                           value="{{$grant->title}}">
                                                    <input name="description"
                                                           type="text"
                                                           class=" form-control advantage_item_{{$loop->iteration}} ml-3"
                                                           value="{{$grant->description}}">
                                                </div>

                                                <div class="d-flex align-items-start ml-5">
                                                    <button class="btn btn-success btn-save">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <div class="btn btn-primary btn-cancel">
                                                        <i class="fa fa-minus"></i>
                                                    </div>
                                                </div>


                                            </form>
                                            <hr>
                                        @endforeach
                                        <div>
                                            <button class="btn btn-success btn-add">
                                                добавить элемент
                                            </button>
                                            <form class="d-none justify-content-between div-line-input mb-3"
                                                  action="{{route('admin.settings.about-grants.store')}}"
                                                  method="post">
                                                @csrf
                                                @method('post')

                                                <div class="d-flex flex-column w-100">
                                                    <input name="title"
                                                           type="text"
                                                           class="form-control ml-3">
                                                    <input name="description"
                                                           type="text"
                                                           class=" form-control ml-3">
                                                </div>
                                                <div class="d-flex align-items-start ml-5">
                                                    <button class="btn btn-success btn-save">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <div class="btn btn-primary btn-cancel">
                                                        <i class="fa fa-minus"></i>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mt-5">
                            <div class="card-header text-center">
                                <h4>Пятый блок</h4>
                            </div>
                            <div class="card-body d-flex">
                                <div class="form-group row col-12">
                                    @foreach($competitions as $competition)
                                        <div class="d-flex w-100 justify-content-between div-line-edit mb-3 mr-5">
                                            <div class="d-flex flex-column">
                                                <h4>{{$competition->title}}</h4>
                                                <p class="advantage_item_{{$loop->iteration}} ml-3">
                                                    {{$competition->description}}
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-start">
                                                <button class="btn btn-success btn-edit">
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#modalAdvantage{{$competition->id}}"><i
                                                        class="fa fa-trash"></i>
                                                </button>
                                                <x-modal name="Вы уверены что хотите удалить?" type="delete"
                                                         action="{{ route('admin.settings.about-competitions.destroy', [$competition->id]) }}"
                                                         targetid="modalAdvantage{{$competition->id }}">
                                                </x-modal>
                                            </div>
                                        </div>


                                        <form class="d-none w-100 justify-content-between div-line-save mb-3 mr-5"
                                              action="{{route('admin.settings.about-competitions.update', $competition->id)}}"
                                              method="post">
                                            @csrf
                                            @method('put')
                                            <div class="d-flex flex-column w-100">
                                                <input name="title"
                                                       type="text"
                                                       class="form-control advantage_item_{{$loop->iteration}} ml-3"
                                                       value="{{$competition->title}}">
                                                <input name="description"
                                                       type="text"
                                                       class=" form-control advantage_item_{{$loop->iteration}} ml-3"
                                                       value="{{$competition->description}}">
                                            </div>

                                            <div class="d-flex align-items-start ml-5">
                                                <button class="btn btn-success btn-save">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <div class="btn btn-primary btn-cancel">
                                                    <i class="fa fa-minus"></i>
                                                </div>
                                            </div>
                                        </form>
                                        <hr>
                                    @endforeach
                                    <div class="col-12">
                                        <button class="btn btn-success btn-add">
                                            добавить элемент
                                        </button>

                                        <form class="d-none justify-content-between div-line-input mb-3"
                                              action="{{route('admin.settings.about-competitions.store')}}"
                                              method="post">
                                            @csrf
                                            @method('post')

                                            <div class="d-flex flex-column w-100">
                                                <input name="title"
                                                       type="text"
                                                       class="form-control ml-3 w-100">
                                                <input name="description"
                                                       type="text"
                                                       class=" form-control ml-3 w-100">
                                            </div>
                                            <div class="d-flex align-items-start ml-5 mr-5">
                                                <button class="btn btn-success btn-save">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                <div class="btn btn-primary btn-cancel">
                                                    <i class="fa fa-minus"></i>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                    <a href="{{route('admin.settings.about.edit', $about->id)}}"
                       class="btn btn-success  col-sm-12">Изменить</a>
                </div>
            </div>
        </div>
    </div>

    </div>

@endsection
@push('script')
    <script>


        let divEdit = document.querySelectorAll('.div-line-edit')
        let divSave = document.querySelectorAll('.div-line-save')
        let divInput = document.querySelectorAll('.div-line-input')

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
        let cancelButtons = document.querySelectorAll('.btn-cancel')
        let addButtons = document.querySelectorAll('.btn-add')


        editButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault()
                closeInputs(divSave)
                openTexts(divEdit)
                let div = button.closest('.div-line-edit')
                div.classList.remove('d-flex')
                div.classList.add('d-none')

                let inputDiv = div.nextElementSibling
                console.log(inputDiv)
                inputDiv.classList.remove('d-none')
                inputDiv.classList.add('d-flex')
            })
        })
        cancelButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault()
                closeInputs(divSave)
                closeInputs(divInput)
                openTexts(divEdit)
                openTexts(addButtons)
            })
        })
        addButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault()
                button.classList.remove('d-flex')
                button.classList.add('d-none')
                let input = button.nextElementSibling
                input.classList.remove('d-none')
                input.classList.add('d-flex')
            })
        })
    </script>
@endpush
