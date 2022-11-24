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
                        <h1 class="m-0">Все направления</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.main.index') }}">Главная</a></li>
                            <li class="breadcrumb-item active">Направления</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @if(session()->has('error'))
            <div class="m-3 alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="col-sm-12 col-md-6  mt-3 mb-3">
                    <a href="{{route('admin.tracks.create')}}"
                       class="btn btn-block btn-primary">Добавить новую траекторию</a>
                </div>
                <div class="card-body table-responsive p-3">

                    @forelse($tracks as $track)
                        <div class="card">
                            <div class="card-header row">
                                <h2 class="col-sm-12 col-lg-8"><a href="{{ route('admin.tracks.show', $track->id) }}">
                                        Направление
                                        "{{ $track->title }}" </a></h2>


                                <div class="col-sm-12 col-lg-4 d-flex justify-content-sm-end align-items-center">

                                    @php $is_added = false; @endphp
                                    @foreach(auth()->user()->tracks as $trackFromUser)
                                        @if($track->id == $trackFromUser->id)
                                            @php $is_added = true; @endphp
                                        @endif
                                    @endforeach

                                    {{--                                        @if($is_added)--}}
                                    {{--                                            <form action="{{ route('admin.tracks.addTrackForUser', $track->id) }}" method="post" style="display: inline">--}}
                                    {{--                                                @csrf--}}
                                    {{--                                                <button class="btn btn-outline-secondary mr-3" type="submit"> <i--}}
                                    {{--                                                        class="fa fa-eye"></i>Удалить траекторию</button>--}}
                                    {{--                                            </form>--}}
                                    {{--                                        @else--}}
                                    {{--                                            <form action="{{ route('admin.tracks.addTrackForUser', $track->id) }}" method="post" style="display: inline">--}}
                                    {{--                                                @csrf--}}
                                    {{--                                                <button class="btn btn-outline-secondary mr-3" type="submit"> <i--}}
                                    {{--                                                        class="fa fa-eye"></i>Добавить тракторию себе</button>--}}
                                    {{--                                            </form>--}}
                                    {{--                                        @endif--}}


                                    <a class="btn btn-outline-secondary mr-3"
                                        href="{{ route('admin.tracks.show', $track->id) }}"> <i
                                            class="fa fa-eye"></i></a>
                                    <a class="btn btn-info mr-3" href="{{ route('admin.tracks.edit', $track->id) }}"> <i
                                            class="fa fa-pen"></i> Изменить</a>

                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteTrack{{$track->id}}">Удалить
                                    </button>

                                    <x-modal name="Вы уверены что хотите удалить?" type="delete"
                                            action="{{ route('admin.tracks.destroy', [$track->id]) }}"
                                            targetid="deleteTrack{{$track->id}}">
                                    </x-modal>
                                </div>

                                <div class="card-body row">
                                    <div class="col-sm-12 col-md-4">
                                        <img src="{{ asset($track->imageNormal ) }}" alt="дизайн" height="150px">
                                    </div>
                                    <table class="col-sm-12 col-md-8">
                                        <tr>
                                            <td>Куратор направления:</td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $track->curator_id) }}">{{ $track->curator->all_names }}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Количество блоков:</td>
                                            <td>{{ $track->blocks_count }} {{$track->name_blocks_count}}</td>
                                        </tr>
                                        <tr>
                                            <td>Всего обучающихся:</td>
                                            <td>{{ $track->users_count }} {{$track->name_users_count}}</td>
                                        </tr>
                                        <tr>
                                            <td>Успеваемость:</td>
                                            <td><span class="status_block status_success">100%</span></td>
                                        </tr>
                                        <tr>
                                            <td>Средний балл:</td>
                                            <td><span
                                                    class="status_block status_success">{{$allAverageMark[$loop->index]}}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="open_blocks mb-3"><img src="{{ asset('images/arrow.png') }}"
                                                                   alt="Открыть блок" width="30px"></div>

                                <div class="card collapse bg-dark mb-3">
                                    <div class="card-body row border-dark">
                                        @forelse($track->blocks as $block)
                                            <div class="col-sm-12 col-lg-6 col-xl-4">
                                                <div class="card bg-white">
                                                    <div class="card-header text-black">
                                                        <h5>{{ $block->id }} | {{ $block->title }}</h5>
                                                    </div>
                                                    <div class="card-body" style="color: #3a4047;">
                                                        <div class="table ">
                                                            <table>
                                                                <tr>
                                                                    <td>Состояние:</td>
                                                                    <td><b>Открыт</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Количество заданий:</td>
                                                                    <td>
                                                                        <b>{{ $block->exercises_count }} {{ $block->name_exercises_count }}</b>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Уровень освоения:</td>
                                                                    <td><b>Простой</b></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    {{-- TODO: Сделать сслыку на block.tasks.show  ? --}}
                                                    <div class="card-footer row mb-3 d-flex justify-content-between">


                                                        <a href="{{route('admin.tracks.blocks.show', [$track->id, $block->id])}}"
                                                           class="btn btn-dark col-sm-12">
                                                            Управление блоком
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="">
                                                <h5>Блоков у этого направления ещё нет</h5>
                                            </div>
                                        @endforelse
                                    </div>

                                    <a href="{{route('admin.tracks.blocks.create',$track->id)}}" class="btn btn-success"
                                       style="width: 100%; height: 40px;"> <i class="fa fa-plus"></i> Добавить новый
                                        блок
                                    </a>
                                </div>

                            </div>
                        </div>
                    @empty
                        <h2>Направления ещё не созданы</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".open_blocks").each(function () {
                $(this).click(function () {
                    $(this).toggleClass('arrow-top');
                    $(this).parent().children('.collapse').slideToggle("fast");
                })
            });
        });
    </script>
@endpush
