@extends('layouts.main')

@push('styles')
<style>
    #img {
        width: 400px;
        height: 400px;
        margin-left: auto;
        margin-right: auto;
    }
</style>
@endpush
@section('content')


<div class="container">
    <div class="main-container-directions">
        <h1 class="h1-content mt-0 mb-4">Поиск по сайту</h1>
        <form action="{{route('posts.search')}}" method="get"
            class="d-flex justify-content-between form-floating col-sm-12 col-md-12 col-lg-12">
            <input type="text" class="mr-3 form-control" name="search" value="{{request('search')}}" id="search"
                placeholder="search">
            <label  for="search">Введите текст</label>
            <button class=" search col-sm-12 col-md-2 col-lg-2">Искать</button>
        </form>
        <div class="mt-2">
            <a class="btn" href="{{route('search', ['search'=>request('search')])}}">Все</a>

            <a class="btn"
                href="{{route('exercises.search', ['search'=>request('search')])}}">Упражнения</a>

            <a class="btn btn-search-active"
                href="{{route('posts.search', ['search'=>request('search')])}}">Новости</a>
        </div>
        <div class="search-content">
            <div class="row">
                @if($posts)
                @forelse($posts as $post)
                <a href="{{route('posts.show',$post->id)}}" class="col-sm-12 col-md-5 search-item"
                    style="text-decoration: none">
                    <span class="text-muted">Новость</span>
                    <p class="h1">{{$post->title}} </p>
                    <p>{!! str_replace("$search","<b>$search</b>", $post->excerpt) !!}</p>
                </a>

                @empty
                <div class="search-not-found">
                    <span>Ничего не нашлось :(</span>
                    <img src="{{ asset('images/search_failed.svg') }}" alt="">
                </div>
                @endforelse
                @else
                <img src="{{asset('storage/search/search.png')}}" class="mt-3" id="img" alt="Поиcк">
                @endif
            </div>
        </div>
        {{-- @dd($posts->links()->pages) --}}
        @if(isset($posts) && $posts->links()->paginator->total() > $posts->links()->paginator->perPage())
        <div class="card">
            <div class="card-body">
                {{ $posts->withQueryString()->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
