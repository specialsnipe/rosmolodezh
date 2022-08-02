@extends('admin.layouts.main')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.main.index')}}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.tracks.index')}}">Направления</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.tracks.show', $track->id) }}">{{$track->title}}</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.tracks.blocks.show',[$track->id, $block->id] )}}">{{$block->title}}</a>
                            </li>

                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.blocks.exercises.show',[$block->id, $exercise->id])}}"
                                >{{$exercise->title}}</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{route('admin.exercises.answers.index', $exercise->id)}}"
                                >Ответы учеников</a></li>
                            <li class="breadcrumb-item active">{{$user->all_names}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" row align-items-center">
                            <h1><a href="{{route('admin.users.show', $user->id)}}">{{$user->all_names}}</a></h1>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="track_name ">
                                    <h3>Упражнение: "{{$exercise->title}}"</h3>
                                </div>
                                <div class="track_name ">
                                    <h4>Траектория: "{{$track->title}}"</h4>
                                </div>
                                <div class="block_name  ">
                                    <h5>Блок: "{{$block->title}}"</h5>
                                </div>
                                <div>
                                    <span>Уровень освоения: </span>
                                    <h5 style="display: inline"><span
                                            title="Уровень:{{ $exercise->complexity->body }}"
                                            class="badge
                                                            @if ($exercise->complexity_id == 1) badge badge-primary @endif
                                                            @if ($exercise->complexity_id == 3) badge badge-warning @endif
                                                            @if ($exercise->complexity_id == 4) badge badge-danger @endif
                                                            @if ($exercise->complexity_id == 5) badge badge-danger @endif
                                                            @if ($exercise->complexity_id == 2) badge badge-success @endif
                                                            ">
                                        {{ $exercise->complexity->level }}
                                        </span>
                                    </h5>
                                </div>
                                <span> Время на выполнение:</span>
                                <h5 style="display: inline">
                                                        <span
                                                            class="
                                                        @if ($exercise->time <= 15) badge badge-primary
                                                        @elseif($exercise->time <= 30) badge badge-success
                                                        @elseif($exercise->time <= 60) badge badge-warning
                                                        @elseif($exercise->time <= 120) badge badge-danger
                                                        @elseif($exercise->time <= 240) badge badge-danger
                                                        @else badge badge-dark @endif
                                                        ">
                                                            {{ $exercise->time }} {{ $exercise->name_minute_count }}
                                                        </span>
                                </h5>
                            </div>

                            <table class="tack_text track_table">
                                <tr>
                                    <td>Оценка за упрежнение:</td>
                                    <td><span class="status_block status_success">
                                        @if($answer->mark)
                                                {{$answer->mark}}
                                            @else
                                                не оценено
                                            @endif
                                    </span></td>
                                </tr>
                                <tr>
                                    <td>Средний балл ученика :</td>
                                    <td><span class="status_block status_success">{{$user->average_mark}}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{--        Body of exercise--}}
        <div class="row">
            <form class="form-inline" action="{{route('admin.exercises.answers.changeMark',[$exercise->id, $answer->id])}}" method="post">
                @csrf
                @method('put')
                <div class="form-group ml-5 mr-2 mt-3">
                    <label for="mark">Выставить оценку: </label>
                    <select type="number" class="form-control ml-1" name="mark" id="mark">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary col-sm-12 mt-3" value="Оценить">
                </div>

            </form>
        </div>
        <div class="p-2 p-md-4 card">
            <div class="card-body p-2 p-md-3">
                <div class="hexlet-markdown-body overflow-hidden">
                    <div class="mb-4 position-relative d-inline-block">
                        <h1 class="my-0 d-flex flex-column-reverse">
                            {{$answer->title}}
                            <span class="sr-only">—</span>
                        </h1>
                    </div>
                    <div>
                        {!!$answer->body!!}
                    </div>
                    <hr class="mt-5">
                    <div class="d-flex flex-wrap flex-lg-nowrap mt-md-4 pt-lg-2 align-items-start">

                        <div class="mt-3 mt-lg-0 w-100">
                            <h3 class=" fw-bold mb-0 lh-base">Прикрепленные файлы:</h3>
                        </div>
                    </div>
                    @forelse($answer->answerFiles as $file)
                        <div>
                            <a href="{{asset($file->fila_name)}}">
                                <button class="btn"><i class="fa fa-download"></i> Download File</button>
                            </a>
                        </div>
                    @empty
                        <div>Файлов нет :(</div>
                    @endforelse
                </div>
            </div>
        </div>



    </div>
@endsection

