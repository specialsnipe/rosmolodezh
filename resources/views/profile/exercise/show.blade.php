@extends('layouts.main')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/exercise-styles.css') }}">
    @livewireStyles
@endpush

@section('content')
    @yield('flash_messages')
    <div class="container mt-3">
        <div class="main-container-directions">
            <div class="header">
                <a href="{{ route('profile.tracks.blocks.show', [$track->slug,$block->slug]) }}"
                    class="btn btn-secondary d-none d-lg-none d-md-none d-sm-block mb-5">< Назад</a>
                <div class="d-flex justify-content-between">
                    <h3 class="h3 text-center">Направление "{{ $block->track->title }}" </h3>
                    <a href="{{ route('profile.tracks.blocks.show', [$track->slug,$block->slug]) . "#exercise_" . $exercise->slug }}"
                        class="btn btn-secondary  d-lg-block d-md-block d-sm-none mb-5">< Назад</a>
                </div>
                <h2 class="h4 w-100">Задание блока "{{ $block->title }}" </h2>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between">
                            <span class="h4">{{ $exercise->title }}</span>
                                <div class="row">
                                    <div class="col-12 d-lg-block d-md-block d-sm-none">
                                        @if((auth()->user()->role->id === 2 || auth()->user()->role->id === 3) && $exercise->user_id === auth()->user()->id)
                                            <form class="d-inline"
                                                action="{{route('profile.blocks.exercises.destroy', [$block->slug, $exercise->slug])}} "
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-block btn-danger">Удалить</button>
                                            </form>
                                        @endif
                                        @if((auth()->user()->role_id === 2 || auth()->user()->role_id === 3) && $exercise->user_id === auth()->user()->id)
                                            <a href="{{ route('profile.blocks.exercises.edit', [$block->slug, $exercise->slug]) }}"
                                                class="btn btn-primary ">Изменить <i class="fa fa-pen"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <span>Уровень освоения: </span>
                                    <h5 style="display: inline"><span title="{{ $exercise->complexity->body }}"
                                                                        class="badge fs-6 bg-{{ $exercise->complexityClassName }}">
                                        {{ $exercise->complexity->level }} </h5>
                                </div>
                                <div class="col-sm-12 mt-1">
                                    <span> Время на выполнение:</span>
                                    <h5 style="display: inline">
                                    <span class="badge fs-6 bg-{{ $exercise->complexityTimeClassName }}">
                                        {{ $exercise->time }} {{ $exercise->name_minute_count }}
                                    </span>
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-none d-lg-none d-md-none d-sm-block mt-4">
                                    @if((auth()->user()->role_id === 2 || auth()->user()->role_id === 3) && $exercise->user_id === auth()->user()->id)
                                        <a href="{{ route('profile.blocks.exercises.edit', [$block->slug, $exercise->slug]) }}"
                                            class="btn btn-primary ">Изменить <i class="fa fa-pen"></i></a>
                                        <form class="d-inline"
                                                action="{{route('profile.blocks.exercises.destroy', [$block->slug, $exercise->slug])}} "
                                                method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-block btn-danger" style="width: 100%">Удалить</button>
                                        </form>
                                    @endif

                                </div>
                            </div>
                            <div class="line mt-3 mb-3"></div>
                            <p class="text-p"> {!! $exercise->body !!}</p>

                        </div>
                    </div>
                </div>

                @if(auth()->user()->role->name == 'student')
                    <div class=" col-xs-12 col-md-8 col-lg-8">
                        @livewire('send-answer-to-exercise-component', ['block' => $block, 'exercise' => $exercise])
                    </div>
                @else
                    <div class="col-xs-12 col-md-8 col-lg-8">
                        @livewire('check-user-answer-component', ['students' => $students, 'exercise' => $exercise])
                    </div>
                @endif

                <div class=" col-xs-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="text-h1">Прикрепленные ссылки</div>
                            <div class="line mt-3 mb-3"></div>
                            <div class="link-content">
                                @forelse ($exercise->links as $link)
                                    <a target="_blank" href="{{ $link->url }}">
                                        <p class="p-header">{{ $link->name }}</p>
                                    </a>
                                @empty

                                    <span>
                                Ссылок не было добавлено
                            </span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">

                            <div class="text-h1">Прикрепленные файлы к заданию</div>
                            <div class="line mt-3 mb-3"></div>
                            <div class="link-content">
                                @forelse ($exercise->files as $file)
                                    <div>
                                        <a href="{{ asset($file->originalPath) }}"
                                            download="{{$file->title.'.'. $file->file_type }}">
                                            <button class="btn btn-secondary"><i class="fa fa-download"></i>
                                                {{$file->title}}.{{ $file->file_type }} ({{$file->file_size}} КБ.)
                                            </button>
                                        </a>
                                    </div>
                                @empty

                                    <span>
                                Файлов не было добавлено
                            </span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    @livewireScripts
@endpush
