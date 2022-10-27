@extends('layouts.main')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
@section('content')
<div class="container">


    @include('profile.includes.flesh-messages')
    <div class="main-container-directions">
        <div class="row">
            <div class="col d-block d-lg-none d-md-block d-sm-block">
                @include('profile.includes.menu')
            </div>
            <h1 class="col-12 text-center mb-5">
                @yield('title', 'Управление')
            </h1>
        </div>
        <div class="row">
            <div class="col d-none d-lg-block d-md-none d-sm-none">
                @include('profile.includes.menu')
            </div>
            <div class="col-sm-12 col-lg-9">
                @yield('profile_content')
            </div>
        </div>
    </div>
</div>
@endsection
