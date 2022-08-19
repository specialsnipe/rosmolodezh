@extends('layouts.main')

@section('content')

<section class="container">
    <p class="h1-content">Новости</p>
    <div class="news-block container-fluid">
        <div class="card-form row d-flex justify-content-between">
            <x-index-posts></x-index-posts>
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
