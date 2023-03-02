@php
use Carbon\Carbon;
@endphp

@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@section('content')

<section class="container">
    <p class="h1-content">Новости</p>
    <div class="news-block container-fluid">
        <div class="card-form">
            <div class="row justify-content-start">
                @forelse ($posts as $post)
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <a class="text-decoration-none" style="color: #000;" target="_blank" href="{{ route('posts.show', ['post'=>$post->slug]) }}">
                            <div class="card post_card mb-4 mr-0">
                                <img src="{{ asset($post->images['0']->imageNormal) }}" class="rounded img-fluid"
                                    style="min-height: 200px; max-height:200px"
                                    alt="Изображение поста '{{ $post->title }}'" height="100">
                                <div class="card-body">
                                    <span class="card-text post__card-text" style="font-size: 13px; color: #ababab">дата: {{ Carbon::parse($post->created_at)->format("Y/m/d") }}</span>
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text post__card-text">{{ $post->excerpt }}</p>
                                </div>
                            </div>
                        </a>
                    </div>

                @empty
                Новостей пока что нет
                @endforelse
            </div>

        </div>
        <nav aria-label="..." class="mb-4">
            {{ $posts->links() }}
        </nav>
    </div>
</section>

@guest
<section class="container">
    <x-registration-form></x-registration-form>
</section>
@endguest
@endsection
