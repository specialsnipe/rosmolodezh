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
                            <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Направления</a></li>
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
                        <form action="{{route('admin.tracks.update', $track->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group w-50">
                                <label for="title">Название направление</label>
                                <input type="text" class="form-control " id="title" name="title" placeholder="Название" value="{{ $track->title}}">
                                @error('title')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            {{-- TODO: Сделать миниатюру загруженного изображения --}}
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
                                <textarea type="text" class="form-control" id="body" name="body" placeholder="Название"> {{ $track->body}} </textarea>
                                @error('body')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50 ">
                                <label for="tg_url">Ссылка на телеграм чат</label>
                                <input type="text" class="form-control " name="tg_url" id='tg_url' placeholder="Телеграмм чат" value="{{$track->tg_url}}">
                                @error('tg_url')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50 mb-5">
                                <label for="curator_id">Куратор направления (все пользователи с ролью 2,3)</label>
                                <select type="text" class="form-control " id="curator_id" name="curator_id">
                                    <option disabled selected> Выберите куратора</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($track->curator_id == $user->id) selected @endif> {{ $user->first_and_last_names }}</option>
                                    @endforeach
                                </select>
                                @error('curator_id')
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
