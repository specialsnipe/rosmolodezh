@php
use Illuminate\Support\Carbon;
$user = auth()->user();
@endphp

@extends('profile.layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
@section('title')
<span class="fs-2"> Направление "{{ $block->track->title }}"</span> <br>
<span class="fs-4 d-flex justify-content-center align-items-center"> Блок "{{ $block->title }}"</span>
@endsection
@section('profile_content')
<article class="col-sm-12">
    <div class="row">
        <div class="col-12">
            <h4 class="h4">Задания данного блока: <a class="btn btn-light pl-2 pt-1 pb-1 pr-2" style="font-size:10px">Редактировать блок</a></h4>
        </div>
        <div class="col-12 mb-3">
            <a href="{{ route("blocks.exercises.create", $block->id) }}" class="btn btn-primary pl-2 pt-1 pb-1 pr-2" style="font-size:10px">Добавить новое задание</a>
        </div>
        <div class="col-12">

            <div class="card-body table-responsive">
                <ul class="list-group">
                    @forelse($block->exercises as $exercise)
                    <li class="list-group-item">
                        <div class="row my-2">
                            <div class="col-1 text-center">
                                <div class="h3 fw-light">{{ $loop->index + 1 }}</div>
                            </div>
                            <div class="col-11">
                                <div class="row">
                                    <h4 class="col-12 d-flex justify-content-between">
                                        <a class="text-decoration-none link-dark me-2"
                                            href="{{ route('blocks.exercises.show', [$block->id, $exercise->id]) }}">{{
                                            $exercise->title }}</a>
                                            <a  href="{{ route('blocks.exercises.edit', [$block->id, $exercise->id]) }}" class="btn btn-light pl-2 pt-1 pb-1 pr-2" style="font-size:10px">Редактировать</a>

                                    </h4>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <span>Уровень освоения: </span>
                                        <h5 style="display: inline"><span title="{{ $exercise->complexity->body }}"
                                                class="badge bg-{{ $exercise->complexityClassName }}">
                                                {{ $exercise->complexity->level }} </h5>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <span> Время на выполнение:</span>
                                        <h5 style="display: inline">
                                            <span class="badge bg-{{ $exercise->complexityTimeClassName }}">
                                                {{ $exercise->time }} {{ $exercise->name_minute_count }}
                                            </span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="mt-3 text-muted text-truncate" style="max-height: 40px">
                                {!! $exercise->excerpt !!}
                                </div>
                                <div class="d-flex justify-content-end align-items-center">
                                    <a href="{{ route("blocks.exercises.show",[$block->id, $exercise->id]) }}"
                                        class="btn btn-primary align-self-end"> Просмотр упражнений и ответов</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @empty
                    Нет заданий
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
</article>
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
