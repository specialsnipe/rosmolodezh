@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Настройки</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Настройки</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card-body table-responsive p-0 w-50">
                    <table class="table table-hover text-nowrap">
                        <tbody>
                        <tr>
                            <td>Вконтакте</td>
                            <td>{{$settings->vk_url}}</td>
                        </tr>
                        <tr>
                            <td>Телеграм</td>
                            <td>{{$settings->tg_url}}</td>
                        </tr>
                        <tr>
                            <td>Одноклассники</td>
                            <td>{{$settings->ok_url}}</td>
                        </tr>
                        <tr>
                            <td>Телефоны</td>
                            @foreach($settings->phones as $phone)
                                <td style="display: flex; flex-direction: column">
                                        <span>
                                            {{$phone->phone}}
                                        </span>
                                </td>
                            @endforeach

                        </tr>
                        <tr>
                            <td>Emails</td>
                            @foreach($settings->emails as $email)
                                <td style="display: flex; flex-direction: column">
                                        <span>
                                            {{$email->email}}
                                        </span>
                                </td>
                            @endforeach

                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row">
                <div class="col-1 mt-3">
                    <a href="{{route('admin.settings.edit', $settings->id)}}"
                       class="btn btn-warning ">Изменить</a>
                </div>

            </div>
        </section>
    </div>
    </div>
@endsection
