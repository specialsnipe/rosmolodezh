@extends('layouts.main')
@push('style')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/exercise-styles.css') }}">
@endpush

@section('content')
<div class="container mt-3">
    <div class="main-container-directions">
        <h3 class="h3 w-100">Направление "{{ $block->track->title }}" </h3>
        <h2 class="h2 w-100">Задание блока "{{ $block->title }}" </h2>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <p class="fs-4">{{ $exercise->title }}</p>
                        <div class="line mt-3 mb-3"></div>
                        <p class="text-p"> {!! $exercise->body !!}</p>
                        @if ($exercise->files->count() > 0)
                        <div class="line mt-3 mb-3"></div>

                        Прикреплённые к заданию файлы
                        @foreach ($exercise->files as $file)

                        @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class=" col-xs-12 col-md-8 col-lg-8 ">
                @livewire('send-answer-to-exercise-component', ['block' => $block, 'exercise' => $exercise])
            </div>


            <div class=" col-xs-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-body">

                        <div class="text-h1">Прикрепленные ссылки</div>
                        <div class="line mt-3 mb-3"></div>
                        <div class="link-content">
                            @forelse ($exercise->links as $link)
                            <a href="{{ $link->url }}">
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
                            <a href="{{ $link->url }}">
                                <p class="p-header">{{ $link->name }}</p>
                            </a>
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
