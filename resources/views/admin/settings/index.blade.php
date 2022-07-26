@extends('admin.layouts.main')
@push('style')
    @livewireScripts
@endpush

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

        <div class="col-12">
            <form action="{{route('admin.settings.update',$setting->id )}}"  method="post">
                @method('put')
                @csrf
                <div class="form-group w-50">
                    <label for=""></label>
                    <input type="text" class="form-control " name="vk_url" value="{{$setting->vk_url}}"
                           placeholder="Название">
                    @error('vk_url')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group w-50">
                    <input type="text" class="form-control " name="tg_url" value="{{$setting->tg_url}}">
                    @error('tg_url')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group w-50 mb-3">
                    <input type="text" class="form-control " name="ok_url" value="{{$setting->ok_url}}">
                    @error('ok_url')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <input type="submit" class="btn btn-primary" value="Сохранить">
            </form>
        </div>
        @livewire('settings-edit-component', ['setting' => $setting])
        <div class="col-12">
            <a href="{{ url()->previous() }}" class="btn btn-primary"> Назад</a>
        </div>
    </div>
@endsection
@push('script')
    @livewireScripts
@endpush
