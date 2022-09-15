
@php
use Illuminate\Support\Carbon;
$user = auth()->user();
@endphp

@extends('profile.layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('title') Просмотр направления "{{ $track->title }}" @endsection
@section('content')

<div class="container">


    <div class="main-container-directions">

        <div class="row">
            <h1 class="col-12 text-center mb-5">Прогресс развития</h1>
        </div>
        <div class="row">

            @include('profile.includes.menu')
            <article class="col-sm-12 col-md-9">
                <div class="row">
                    <h4 class="h4 col-12 text-center mb-5">Направление "{{ $track->title }}"</h4>
                    <div class="col-sm-12 col-md-6 table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="p-3">Куратор направления</td>
                                    <td>{{ auth()->user()->tracks[0]->curator->all_names }}</td>
                                </tr>
                                <tr class="p-3">
                                    <td class="p-3">Номер телефона куратора</td>
                                    <td>{{ auth()->user()->tracks[0]->curator->phone }}</td>
                                </tr>
                                <tr class="p-3">
                                    <td class="p-3">Телеграм куратора</td>
                                    <td>{{ auth()->user()->tracks[0]->curator->tg_name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-12 col-md-6 ">
                        <table class="table table-responsive">
                            <tbody>
                                <tr>
                                    <td class="p-3">Решено задач</td>
                                    <td>{{$user->getSolvedTrackExercisesAttribute($track->id)}}</td>
                                </tr>
                                <tr class="p-3">
                                    <td class="p-3">Средний балл</td>
                                    <td>{{$user->getAverageMarkTrackAttribute($track->id)}}</td>
                                </tr>
                                <tr class="p-3">
                                    <td class="p-3">Получено оценок</td>
                                    <td>{{$user->getAnswerMarkCountAttribute($track->id)}}</td>
                                </tr>
                            </tbody>
                        </table>
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
                                                <a href="{{ route( 'tracks.blocks.show', [$block->track_id, $block->id]) }}" class="h5 text-decoration-none">Блок: {{ $block->title }}</a> <br>
                                            @endif
                                            Начало блока: {{  $block->date_start->format('d.m.Y') }}
                                        </p>
                                    </div>

                                        @if(!($block->date_start >= Carbon::now()))
                                        <div class="col-sm-12 col-lg-6 d-flex justify-content-end">
                                            <form
                                                @if($block->exercises_count < 1)
                                                    action="#"
                                                @else
                                                    action="{{ route( 'tracks.blocks.show', [$block->track_id, $block->id]) }}"
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
                                        @if($loop->first) <div class="fs-6 mt-0 mb-2">Задания блока:</div> @endif
                                        <a href="{{ route('blocks.exercises.show', [$block->id,$exercise->id]) }}" class="fs-6">{{ $exercise->title }}</a>
                                    @empty
                                    <div class="fs-6 mt-0 mb-2">К данному блоку ещё не добавили заданий :(</div>
                                    @endforelse
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
        $("input[type=text]").keydown(function(event){
      if(event.keyCode == 13){
        event.preventDefault();
          return false;
          }
      });
    </script>
@endpush
