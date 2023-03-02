@php
use Illuminate\Support\Carbon;
$user = auth()->user();
@endphp

@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')

<div class="container">
    @include('profile.includes.flesh-messages')
    <div class="main-container-directions">

        <div class="row">
            @if($block->beforeBlockUrl)
                <div class="col-sm-12 col-md-2 mb-5"><a  href="{{ $block->beforeBlockUrl }}" class="btn btn-primary w-100">Предыдущий блок</a></div>
            @else
                <div class="col-2"></div>
            @endif
            <h1 class="col-sm-12 col-md-8 text-center mb-5">"{{ $block->title }}"</h1>
            @if($block->nextBlockUrl)
                <div class="col-sm-12 col-md-2"><a href="{{ $block->nextBlockUrl }}" class="btn btn-primary w-100">Следущий блок</a></div>
            @else
                <div class="col-2"></div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-3">

                @include('profile.includes.menu')
            </div>
            <article class="col-sm-12 col-md-9">
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="d-flex justify-content-center">
                            <img src="{{ $block->imageNormal }}" alt="" class="img-fluid single-image rounded">
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <h4 class="">Задания данного блока:</h4>
                    </div>
                    <div class="col-12">

                        <div class="card-body table-responsive">
                            <ul class="list-group">
                                @forelse($block->exercises as $exercise)
                                <li class="list-group-item border-{{ auth()->user()->getAnswer($exercise)->class_name ?? 'light' }}" id="{{ 'exercise_' . $exercise->slug }}" >
                                    <div class="row my-2">
                                        <div class="col-1 text-center">
                                            <div class="h3 fw-light">{{ $loop->index + 1 }}</div>
                                        </div>
                                        <div class="col-11">
                                            <div class="row">
                                                <h4 class="col-8">
                                                    <a class="text-decoration-none link-dark me-2"
                                                        href="{{ route('profile.blocks.exercises.show', [$block->slug, $exercise->slug]) }}">{{
                                                        $exercise->title }}</a>
                                                </h4>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                <span>Уровень освоения: </span>
                                                <h5 style="display: inline"><span
                                                        title="{{ $exercise->complexity->body }}"
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
                                                @if ($exercise->answers->where('user_id', auth()->user()->id)->where('exercise_id', $exercise->id)->first() != null)
                                                <div class="col-sm-12 col-md-6 mt-1">
                                                    <span  class="mt-2"> Ваша оценка:</span>
                                                    <h5 style="display: inline">
                                                        <span class="badge bg-{{ auth()->user()->getAnswer($exercise)->class_name ?? 'primary' }}">
                                                            {{ auth()->user()->getAnswer($exercise)->mark ? auth()->user()->getAnswer($exercise)->mark: 'не проверено' }}
                                                        </span>
                                                    </h5>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="mt-3 text-muted text-truncate" style="max-height: 40px">{!! $exercise->excerpt !!}
                                            </div>
                                            <div class="d-flex justify-content-end align-items-center">
                                                @if ($exercise->answers->where('user_id', auth()->user()->id)->where('exercise_id', $exercise->id)->first() != null)
                                                <span> Вы уже оставили ответ &nbsp&nbsp</span> <a href="{{ route("profile.blocks.exercises.show", [$block->slug, $exercise->slug]) }}" class="btn btn-success align-self-end">Изменить ответ</a>

                                                @else

                                                <a href="{{ route("profile.blocks.exercises.show", [$block->slug, $exercise->slug]) }}" class="btn btn-primary align-self-end">Просмотреть и выполнить задание</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @empty
                                Нет заданий
                                @endforelse
                            </ul>
                        </div>
                        <div class="row mt-3">
                        @if($block->beforeBlockUrl)
                            <div class="col-6"><a  href="{{ $block->beforeBlockUrl }}" class="btn btn-secondary w-100">Предыдущий блок</a></div>
                        @else
                            <div class="col-6"></div>
                        @endif
                        @if($block->nextBlockUrl)
                            <div class="col-6"><a href="{{ $block->nextBlockUrl }}" class="btn btn-secondary w-100">Следущий блок</a></div>
                        @else
                            <div class="col-6"></div>
                        @endif</div>
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
    const singleImage = document.querySelector('.single-image');
    if (singleImage) {
        let ghostingImage = singleImage.cloneNode(true);
        ghostingImage.style.maxWidth = '100%';
        ghostingImage.style.width = '100%';
        ghostingImage.style.maxHeight = '100%';
        ghostingImage.style.height = '100%';
        ghostingImage.style.position = 'absolute';
        ghostingImage.style.objectFit = 'cover';
        ghostingImage.style.zIndex = '1';
        ghostingImage.style.opacity = '0.2';

        singleImage.parentNode.style.position = 'relative';
        singleImage.style.zIndex = '10';
        singleImage.parentNode.appendChild(ghostingImage);
    }
</script>
@endpush
