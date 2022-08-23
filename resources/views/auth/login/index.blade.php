@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@section('content')
    <x-login-form></x-login-form>
@endsection
