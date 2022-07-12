@extends('admin.layouts.main')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/track_styles.css') }}">
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Направление "{{ $track->title }}"</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('admin.tracks.index') }}">Направления</a></li>
                            <li class="breadcrumb-item active">Направление "{{ $track->title }}"</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="row">
            <div class="col-12 m-3">
                <div class="card w-75">
                    <div class="card-header">
                        Направление {{ $track->title }}
                    </div>
                    <div class="card-body">
                        <div class="tack_header">
                            <h1>Направление "{{ $track->title }}"</h1>
                            <div class="track_manage_tab">
                                <a href="{{ route('admin.tracks.show', $track->id) }}"> <i class="fa fa-eye"></i></a>
                                <a href="{{ route('admin.tracks.edit', $track->id) }}">Изменить <i class="fa fa-pen"></i></a>
                                {{-- TODO: Сделать модальное окно подтверждения об удалении с подтвержением пароля пользователя --}}
                                <a href="#">Удалить <i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                        <div class="tack_info">
                            <div class="track_image">
                                <img src="{{ asset($track->image_original) }}" alt="дизайн" height="150px">
                            </div>
                            <table class="tack_text track_table">
                                <tr>
                                    <td>Куратор направления: </td>
                                    <td><a href="{{ route('admin.users.show', $track->curator_id) }}">{{ $track->curator->all_names }}</a></td>
                                </tr>
                                <tr>
                                    <td>Количество блоков: </td>
                                    <td>{{ $track->blocks_count }} блоков</td>
                                </tr>
                                <tr>
                                    <td>Всего обучающихся: </td>
                                    <td>{{ $track->users_count }} человек</td>
                                </tr>
                                <tr>
                                    <td>Успеваемость:  </td>
                                    <td><span class="status_block status_success">100%</span></td>
                                </tr>
                                <tr>
                                    <td>Средний балл: </td>
                                    <td><span class="status_block status_success">4.7</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="col-4 mt-3 mb-3">
                    <a href="{{route('admin.blocks.create')}}"
                       class="btn btn-block btn-primary">Добавить новый блок</a>
                </div>
                <div class="card-body table-responsive p-3">


                    @forelse($blocks as $block)
                    <div id="accordion" role="tablist" aria-multiselectable="true">

                        <div class="card">
                            <div class="card-header" role="tab">
                                <h5 class="mb-0">
                                    <span data-toggle="collapse" data-parent="#accordion"
                                       aria-expanded="true"
                                       aria-controls="collapseOne">
                                       {{ $loop->index + 1 }} | Блок - "{{ $block->title }}" (id:{{$block->id}})
                                    </span>
                                </h5>
                            </div>

                            <div class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-block pt-2 pl-3">
                                    @forelse($block->exercises as $exercise)
                                        @if($loop->first)
                                            <table class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Название задания</th>
                                                    <th>Создатель</th>
                                                    <th>Дата создания</th>
                                                    <th>Статистика</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        @endif
                                                <tr>
                                                    <td>{{ $exercise->id }}</td>
                                                    <td>{{ $exercise->title }}</td>
                                                    <td>{{ $exercise->creator->first_and_last_names }}</td>
                                                    <td>{{ $exercise->created_at }}</td>
                                                    <td>
                                                        <table>
                                                            <tr>
                                                                <td>Время на выполнение: </td>
                                                                <td>2 часа</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Сдано работ:</td>
                                                                <td>10/{{ $track->users_count }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Успеваемость: </td>
                                                                <td><span class="status_block status_success">100%</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Средний балл: </td>
                                                                <td><span class="status_block status_success">4.1</span></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                        @if($loop->last)
                                            </tbody>
                                        </table>
                                        @endif
                                    @empty
                                        <p>В данном блоке пока что нет заданий :(</p> <div class="btn btn-success mb-3"> Добавить задание </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".card-header").each(function () {
                $(this).click(function () {
                    $(this).parent().children('.collapse').slideToggle("fast");
                })
            });
        });
    </script>
@endpush
