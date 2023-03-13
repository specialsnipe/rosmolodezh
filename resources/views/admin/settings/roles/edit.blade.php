@extends('admin.layouts.main')


@section('content')

    <div class="content-wrapper" style="padding-top: 1rem">
        <!-- Content Header (Page header) -->
        <div class="row d-flex justify-content-between mr-3 ml-3">
            <div class="col-sm-6">
                <h1 class="">Изменение роли: "{{$role->name}}"</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.settings.index')}}">Настройки</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.settings.roles.index')}}">Роли</a></li>
                            <li class="breadcrumb-item active">Изменение роли: {{$role->name}}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="col-6">
            <form action="{{route('admin.settings.roles.update', $role->id)}}" method="post">
                @csrf
                @method('patch')
                <div class="form-group ml-3 ">
                    <label for="exampleInputEmail1">Введите роль</label>
                    <input type="text" class="form-control" id="gender" name="name" value="{{$role->name}}" placeholder="Роль">
                    @error('name')
                    <div class="text-danger">{{$message }}</div>
                    @enderror
                </div>

                <div class="col-sm-12 ml-2 mb-3">
                    <label>Выберите доступы</label>
                    <select class="select2" name="permission_id[]" multiple="multiple"
                            data-placeholder="Выберите " style="width: 100%;">
                        @foreach($permissions as $permission)
                            <option

                                @if(($role->permissions->contains($permission))) selected
                                @endif
                                    value="{{$permission->id}}">{{$permission->readable_title}}</option>
                        @endforeach
                    </select>
                </div>

                <input type="submit" class="btn btn-primary w-50 ml-3 col-sm-12" value="Сохранить">
            </form>
        </div>
    </div>


@endsection
