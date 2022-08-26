@extends('layouts.main')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
@section('content')
<div class="container">


    <div class="main-container-directions">
        <div class="row">
            <h1 class="col-12 text-center mb-5">

                @yield('title', 'Управление')
            </h1>
        </div>
        <div class="row">

            @include('profile.includes.menu')
            <article class="col-sm-12 col-md-9">
                @yield('profile_content')
            </article>
        </div>
    </div>
</div>
@endsection
