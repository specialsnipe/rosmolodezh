@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">

<style>

    .show-more  {
        text-decoration: none;
        cursor: pointer;
        color: inherit;
    }
    .text-about  {
        max-width: 70%;
    }
    .text-truncated {
        overflow: hidden;
        height: 70px;
    }
    .text-about {
        transition: height 0.2s;
        -moz-transition: height 0.2s; /* Firefox 4 */
        -webkit-transition: height 0.2s; /* Safari and Chrome */
        -o-transition: height 0.2s; /* Opera */
    }
    .text-showed {
        height: auto !important;
        overflow: hidden;
    }
    .content-body {
        max-height: auto;
        z-index: 2;
    }
    .bg-icon {
        position: absolute;
        top:0;
        width: 100%;
        height: 200px;
        z-index: 1;
    }
    .fa-angle-up {
        transition: 100ms;
    }

    .fa-angle-up.reverse {
        transform: rotate(180deg);
    }
    .phrase-bg-img-2 {
        transition: 200ms;
    }
</style>
@endpush

@section('content')

<div class="container mb-5 mt-5">
        <h1 class="h1-content mt-0 mb-4">Информация партнёрам</h1>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card content-info">
                    <div class="card-body content-body">
                        <h5 class="card-title">{{ $partnership->title }}</h5>
                        <p class="card-text">{!! $partnership->body !!}</p>
                    </div>
                    <div class="bg-icon w-100">
                        <div class="phrase-bg-img-1"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center mt-1">
            @forelse ($partnership->partnershipItems as $item)
            <div class="col-md-6">
                <div class="card content-info">

                <div class="card-body content-body">

                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="text-about text-truncated card-text">
                        {!! $item->body !!}
                    </p>
                </div>

                <div class="bg-icon w-100">
                    <div class="phrase-bg-img-2"></div>
                </div>
                </div>
            </div>
            @empty
            <div class="col-md-12">
                <div class="card content-info">

                <div class="card-body content-body">

                    <h5 class="card-title">Пока что нам нечего вам покаазть</h5>
                    <p class="text-about text-truncated card-text">
                    </p>


                </div>

                <div class="bg-icon w-100">
                    <div class="phrase-bg-img-2"></div>
                </div>
                </div>
            </div>
            @endforelse

        </div>
</div>

@endsection

@push('script')


@endpush
