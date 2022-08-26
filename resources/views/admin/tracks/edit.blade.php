@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Изменение направления</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.tracks.index')}}">Направления</a></li>
                            <li class="breadcrumb-item active">Изменение направления</li>
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
                        <form action="{{route('admin.tracks.update', $track->id)}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group w-50">
                                <label for="title">Название направление</label>
                                <input type="text" class="form-control " id="title" name="title" placeholder="Название"
                                       value="{{ $track->title}}">
                                @error('title')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            {{-- TODO: Сделать миниатюру загруженного изображения --}}

                            <div>
                                <img src="{{ asset($track->image_original) }}" alt="дизайн" height="150px">
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
                            <div>
                                <img src="{{ asset($track->icon_thumbnail) }}" alt="" width="100px">
                            </div>
                            {{-- TODO: Сделать миниатюру загруженного изображения --}}
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
                                <textarea type="text" class="form-control" id="body" name="body"
                                          placeholder="Название"> {{ $track->body}} </textarea>
                                @error('body')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50 ">
                                <label for="tg_url">Ссылка на телеграм чат</label>
                                <input type="text" class="form-control " name="tg_url" id='tg_url'
                                       placeholder="Телеграмм чат" value="{{$track->tg_url}}">
                                @error('tg_url')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50 mb-3">
                                <label for="curator_id">Куратор направления (все пользователи с ролью 2)</label>
                                <select type="text" class="form-control " id="curator_id" name="curator_id">
                                    <option value="0" disabled selected> Выберите куратора</option>

                                    @foreach($users as $user)

                                        <option value="{{ $user->id }}"
                                                @if($track->curator_id == $user->id) selected
                                            @endif> {{ $user->first_and_last_names }}</option>
                                    @endforeach
                                </select>
                                @error('curator_id')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-sm-12 col-md-4 col-lg-3 mb-3">
                                <label for="teacher_id">Преподаватель направления (все пользователи с ролью 3)</label>
                                <select class="select2" name="teacher_id[]" multiple="multiple"
                                        data-placeholder="Выберите преподавателя" style="width: 100%;">

                                    @foreach($users as $user)
                                        <option {{ is_array($teachers_ids) &&
                                                in_array($user->id, $teachers_ids)?'selected':''}}
                                                value="{{$user->id}}">{{$user->first_and_last_names}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group w-50">
                                <label for="title">Место работы куратора<span class="text-secondary">(Информация будет отображена в карточке направления)</span></label>
                                <input type="text" class="form-control " id="title" name="curator_job" placeholder="Место работы куратора" value="{{$curator->curator_job}}">
                                @error('curator_job')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50 mb-5">
                                <label for="body">О кураторе<span class="text-secondary">(Информация будет отображена в карточке направления)</span></label>
                                <textarea type="text" class="form-control" id="body" name="curator_about" placeholder="О кураторе"> {{$curator->curator_about}} </textarea>
                                @error('curator_about')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-primary" value="Изменить">
                        </form>
                    </div>

                </div>
                <!-- /.row -->

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
