@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Добавление нового направления</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.tracks.index')}}">Направления</a></li>
                            <li class="breadcrumb-item active">Добавление нового направления</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('admin.tracks.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group w-50">
                                <label for="title">Название направление</label>
                                <input type="text" class="form-control " id="title" name="title" placeholder="Название" value="{{old('title')}}">
                                @error('title')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50">
                                <label for="exampleInputFile">Загрузите изображение направления</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image" id="exampleInputFile"
                                               value="" multiple>
                                        <label class="custom-file-label" for="exampleInputFile">Выберите
                                            картинку</label>
                                    </div>
                                </div>

                                @if($errors->has('image'))
                                    @foreach($errors->get('image') as $error)
                                        <div class="text-danger">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="form-group w-50">
                                <label for="exampleInputFile2">Загрузите иконку направления</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="icon" id="exampleInputFile"
                                               value="{{old('icon')}}" multiple>
                                        <label class="custom-file-label" for="exampleInputFile2">Выберите
                                            картинку</label>
                                    </div>
                                </div>
                                @error('icon')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50">
                                <label for="body">Описание направления</label>
                                <textarea type="text" class="form-control" id="body" name="body" placeholder="Название"> {{old('body')}} </textarea>
                                @error('body')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50 ">
                                <label for="tg_url">Ссылка на телеграм чат</label>
                                <input type="text" class="form-control " name="tg_url" id='tg_url' placeholder="Телеграмм чат" value="{{old('tg_url')}}">
                                @error('tg_url')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50 mt-5">
                                <label for="curator_id">Куратор направления</label>
                                <select type="text" class="form-control " id="curator_id" name="curator_id">
                                    <option disabled selected> Выберите куратора</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if(old('curator_id') == $user->id) selected @endif> {{ $user->first_and_last_names }}</option>
                                    @endforeach
                                </select>
                                @error('curator_id')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-sm-12 col-md-4 col-lg-3 mb-3">
                                <label for="teacher_id">Преподаватель направления</label>
                                <select class="select2" name="teacher_id[]" multiple="multiple"
                                        data-placeholder="Выберите преподавателя" style="width: 100%;">

                                    @foreach($users as $user)
                                        <option {{ is_array(old('teacher_id')) &&
                                                in_array($user->id, old('teacher_id'))?'selected':''}}
                                                value="{{$user->id}}">{{$user->first_and_last_names}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Добавить">
                        </form>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
