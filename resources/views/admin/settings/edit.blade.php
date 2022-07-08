@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактирование настроек</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                            <li class="breadcrumb-item active">Редактирование настроек</li>
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
                    <form action="{{route('admin.settings.update', $setting->id)}}" method="post" >
                        @csrf
                        @method('patch')
                        <div class="form-group w-50">
                            <input type="text" class="form-control " name="vk_url" placeholder="Название" value="{{$setting->vk_url}}">
                            @error('vk_url')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50">
                            <input type="text" class="form-control " name="tg_url" placeholder="Название" value="{{$setting->tg_url}}">
                            @error('tg_url')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group w-50 mb-5">
                            <input type="text" class="form-control " name="ok_url" placeholder="Название" value="{{$setting->ok_url}}">
                            @error('ok_url')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-5">
                        @foreach($setting->phones as $phone)
                        <div class="form-group w-50">
                            <input type="text" class="form-control " name="phone" placeholder="Название" value="{{$phone->phone}}">
                            @error('ok_url')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        @endforeach
                        </div>
                        <div class="row w-50 mb-3">
                            <input type="text" class="col-8 form-control " name="email" placeholder="Название" value="">
                            <button type="submit" class="col-4 btn btn-default " >Добавить новую почту</button>
                        </div>
                        <div class="mb-5">
                            @foreach($setting->emails as $email)
                                <div class="row form-group w-50">
                                    <span class="form-control col-10">{{$email->email}}</span>
                                    <span class="btn btn-info col-1">ed</span>
                                    <span class="btn btn-danger col-1">del</span>
                                    @error('ok_url')
                                    <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            @endforeach
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
