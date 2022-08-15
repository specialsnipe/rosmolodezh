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

    <div class="card m-3">
        <div class="card-body">
            <form action="{{route('admin.settings.update',$setting->id )}}" method="post" class="row">
                @method('put')
                @csrf
                <div class="form-group  col-sm-12 col-md-4">
                    <label for="vk_url">Вконтакте url</label>
                    <input type="text" class="form-control " name="vk_url" value="{{$setting->vk_url}}"
                        placeholder="Название">
                    @error('vk_url')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group col-sm-12 col-md-8">
                    <label for="vk_description">Краткое описание</label>
                    <textarea type="text" class="form-control " name="vk_description" >{{$setting->vk_description}}</textarea>
                    @error('vk_description')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <hr class="col-12" style="padding: 0">
                <div class="form-group  col-sm-12 col-md-4 ">
                    <label for="tg_url">Телеграм url</label>
                    <input type="text" class="form-control " name="tg_url" value="{{$setting->tg_url}}">
                    @error('tg_url')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group col-sm-12 col-md-8 ">
                    <label for="tg_description">Краткое описание</label>
                    <textarea type="text" class="form-control " name="tg_description" >{{$setting->tg_description}}</textarea>
                    @error('tg_description')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <hr class="col-12"  style="padding: 0">
                <div class="form-group  col-sm-12 col-md-4">
                    <label for="ok_url">Одноклассники url</label>
                    <input type="text" class="form-control " name="ok_url" value="{{$setting->ok_url}}">
                    @error('ok_url')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group col-sm-12 col-md-8">
                    <label for="vk_url">Краткое описание</label>
                    <textarea type="text" class="form-control " name="ok_description" >{{$setting->ok_description}}</textarea>
                    @error('ok_description')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <hr class="col-12"  style="padding: 0;height:1px;border:none;color:#333;background-color:#333;">
                <div class="form-group  col-sm-12 col-md-8">
                    <label for="location">Адрес</label>
                    <input type="text" class="form-control " name="location" value="{{$setting->location}}">
                    @error('location')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group  col-sm-12 col-md-12">
                    <label for="location_url">url адреса</label>
                    <input type="text" class="form-control " name="location_url" value="{{$setting->location_url}}">
                    @error('location_url')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group col-sm-12 col-md-12">
                    <label for="location_description">Краткое описание</label>
                    <textarea type="text" class="form-control " name="location_description" >{{$setting->location_description}}</textarea>
                    @error('location_description')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

                <div class=" col-sm-12 col-md-12">
                    <input type="submit" class="btn btn-primary w-100" value="Сохранить">
                </div>
            </form>
        </div>
    </div>
    @livewire('information-edit-component', ['setting' => $setting])
    <div class="card m-3">
        <div class="card-body">
            <a href="{{ url()->previous() }}" class="btn btn-primary"> Назад</a>
        </div>
    </div>
</div>
@endsection

@push('script')
@livewireScripts
<script>
    window.addEventListener("DOMContentLoaded", function() {
            [].forEach.call( document.querySelectorAll('#phone'), function(input) {
                var keyCode;
                function mask(event) {
                    event.keyCode && (keyCode = event.keyCode);
                    var pos = this.selectionStart;
                    if (pos < 3) event.preventDefault();
                    var matrix = "+7 (___) ___ ____",
                        i = 0,
                        def = matrix.replace(/\D/g, ""),
                        val = this.value.replace(/\D/g, ""),
                        new_value = matrix.replace(/[_\d]/g, function(a) {
                            return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                        });
                    i = new_value.indexOf("_");
                    if (i != -1) {
                        i < 5 && (i = 3);
                        new_value = new_value.slice(0, i)
                    }
                    var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                        function(a) {
                            return "\\d{1," + a.length + "}"
                        }).replace(/[+()]/g, "\\$&");
                    reg = new RegExp("^" + reg + "$");
                    if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
                    if (event.type == "blur" && this.value.length < 5)  this.value = ""
                }

                input.addEventListener("input", mask, false);
                input.addEventListener("focus", mask, false);
                input.addEventListener("blur", mask, false);
                input.addEventListener("keydown", mask, false)

            });

        });
</script>
@endpush
