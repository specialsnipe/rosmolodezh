@php
    use Illuminate\Support\Carbon;
    $user = auth()->user();
@endphp

@extends('profile.layouts.main')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('title')
    Просмотр направления "{{ $track->title }}"
@endsection
@section('content')

    <div class="container">

        @include('profile.includes.flesh-messages')
        <div class="main-container-directions">

            <div class="row">
                <h1 class="col-12 text-center mb-5">Прогресс развития</h1>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    @include('profile.includes.menu')
                </div>
                <article class="col-sm-12 col-md-9">
                    <div class="row">
                        <h4 class="h4 col-12 text-center mb-5">Направление "{{ $track->title }}"</h4>
                        <div class="col-sm-12">
                            <div class="row mb-5">
                                <div class="col-sm-12 col-md-6">
                                    <div class="info-track">
                                        <span class="info-track__title">Куратор направления</span>
                                        <span>{{ auth()->user()->tracks[0]->curator->all_names }}</span>
                                    </div>
                                    <div class="info-track">
                                        <span class="info-track__title">Номер телефона куратора</span>
                                        <span>{{ auth()->user()->tracks[0]->curator->phone }}</span>
                                    </div>
                                    <div class="info-track">
                                        <span class="info-track__title">Телеграм куратора</span>
                                        <span>{!!
                                            auth()->user()->tracks[0]->curator->tg_name
                                                ? "<a href='http://t.me/" . auth()->user()->tracks[0]->curator->tg_name . "'>@" . auth()->user()->tracks[0]->curator->tg_name ."</a>"
                                                : "не найдено"
                                        !!}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6" style="padding:0 10px 0 10px">
                                    <div class="info-track">
                                        <span class="info-track__title">Решено задач</span>
                                        <span>{{$user->getSolvedTrackExercisesAttribute($track->id)}}</span>
                                    </div>
                                    <div class="info-track">
                                        <span class="info-track__title">Средний балл</span>
                                        <span>{{$user->getAverageMarkTrackAttribute($track->id)}}</span>
                                    </div>
                                    <div class="info-track">
                                        <span class="info-track__title">Получено оценок</span>
                                        <span>{{$user->getAnswerMarkCountAttribute($track->id)}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="h4 col-12 text-center mt-3 mb-3">Блоки и задачи этого направления</h4>
                        <div class="col-sm-12">
                            @foreach ($track->blocks as $block)
                                <div class="card mb-4
                            @if($block->date_start >= Carbon::now())
                                locked-task
                            @endif
                        ">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-6">

                                                <p class="fs-5">
                                                    @if(!($block->date_start >= Carbon::now()))
                                                        <a href="{{ route('profile.tracks.blocks.show', [$track->slug, $block->slug]) }}"
                                                           class="h5 text-decoration-none">Блок: {{ $block->title }}</a>
                                                        <br>
                                                    @endif
                                                </p>
                                            </div>

                                            @if(!($block->date_start >= Carbon::now()))
                                                <div class="col-sm-12 col-lg-6 d-flex-btn">
                                                    <form
                                                        @if($block->exercises_count < 1)
                                                            action="#"
                                                        @else
                                                            action="{{ route('profile.tracks.blocks.show', [$track->slug, $block->slug]) }}"
                                                        @endif
                                                        method='get'
                                                        class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn
                                                @if(auth()->user()->started_blocks->where('id', $block->id)->first() == null)
                                                btn-primary
                                                @else
                                                btn-success
                                                @endif
                                                " @if($block->exercises_count < 1) disabled @endif>
                                                            @if($block->exercises_count < 1)
                                                                У данного блока нет упражнений
                                                            @else
                                                                @if(auth()->user()->started_blocks->where('id', $block->id)->first() == null)
                                                                    Начать выполение блока
                                                                @else
                                                                    Продолжить выполнение блока
                                                                @endif
                                                            @endif
                                                        </button>

                                                    </form>
                                                </div>
                                            @else
                                                <div class="col-sm-12 col-lg-6 d-flex justify-content-end">
                                                    <form
                                                        action="#"
                                                        method='post'
                                                        class="d-inline">

                                                        <button type="submit" class="btn btn-primary" disabled>
                                                            Блок ещё не начался
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="d-flex flex-md-column exercise-block">


                                            @forelse ($block->exercises as $exercise)
                                                @if($loop->first)
                                                    <div class="fs-6 mt-0 mb-2">Задания блока:</div>
                                                @endif

                                                @if (auth()->user()->getAnswer($exercise))
                                                    <span class="
                                                text-{{ auth()->user()->getAnswer($exercise)->class_name }}
                                                d-flex align-items-center
                                            ">
                                                <div class="custom-checkbox">
                                                    <i class="fa-solid fa-check"></i>
                                                </div>
                                                <a href="{{ route('profile.blocks.exercises.show', [$block->slug, $exercise->slug]) }}"
                                                   class="fs-6 text-decoration-none"
                                                   style="color: inherit"> {{ $exercise->title }}</a>

                                            </span>
                                                @else
                                                    <span class="d-flex align-items-center">
                                                    <div class="custom-checkbox">
                                                    </div>
                                                <a href="{{ route('profile.blocks.exercises.show', [$block->slug,$exercise->slug]) }}"
                                                   class="fs-6 text-decoration-none "
                                                   style="color: inherit"> {{ $exercise->title }}</a>
                                            </span>
                                                @endif
                                            @empty
                                                <div class="fs-6 mt-0 mb-2">К данному блоку ещё не добавили заданий :(
                                                </div>
                                            @endforelse
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <small class="fs-8">Начало
                                                блока: {{  $block->date_start->format('d.m.Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </article>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $("input[type=text]").keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    </script>
@endpush
