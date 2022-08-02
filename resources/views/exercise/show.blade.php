@extends('layouts.main')

@section('content')
<main style="
    display: flex;
    justify-content: center;">
    
<div class="content mt-3">
<p class="h1-content">Страница с заданием </p>
    <div class="descriptions col-sm-12 col-md-12 col-lg-12">
        <p class="text-h1">{{ $exercise->title }}</p>
        <div class="line"></div>
        <p class="text-p"> {!! $exercise->body !!}</p>
    </div>

    <div class="player"></div>

    <div class="content-down">

        <div class="submit-task col-xs-12 col-md-7 col-lg-7 ">
            <div class="text-h1">Отправить ответ на задание</div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                    style="min-height: 250px"></textarea>
                <label for="floatingTextarea2">Введите ваш ответ...</label>
            </div>
            <div class="btn-container">
                <div class="line"></div>
                <div class="icon-content">
                    <i class="fas fa-file"></i>
                    <i class="fas fa-file"></i>
                    <i class="fas fa-file"></i>
                    <i class="fas fa-file"></i>
                </div>
                <div class="line"></div>
                <button class="attach-file">Прекрепить файлы</button>
                <button class="btn-send">Отправить</button>
            </div>
        </div>


        <div class="add-materials col-xs-12 col-md-4 col-lg-4">
            <div class="text-h1">Полезные ресурсы</div>
            <div class="line"></div>
            <div class="link-content">
                @forelse ($exercise->links as $link)
                <a href="{{ $link->url }}">
                    <p class="p-header">{{ $link->name }}</p>
                </a>
                @empty

                <a href="#">
                    Никаких ссылок нет
                </a>
                @endforelse
            </div>

        </div>
    </div>
</div>
</main>
@endsection
