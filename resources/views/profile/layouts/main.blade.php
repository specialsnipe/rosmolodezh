@extends('layouts.main')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
@section('content')
<div class="container">


    @yield('flash_messages')
    <div class="main-container-directions">
        <div class="row">
            <h1 class="col-12 text-center mb-5">

                @yield('title', 'Управление')
            </h1>
        </div>
        <div class="row">

            @include('profile.includes.menu')
            <div class="col-sm-12 col-md-9">
                @yield('profile_content')
            </div>
        </div>
    </div>
</div>
@endsection
