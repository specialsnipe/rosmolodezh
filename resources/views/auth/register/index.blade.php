@extends('layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/media.css') }}">
@endpush

@section('content')
<div class="container">
    <x-registration-form></x-registration-form>
</div>
@endsection
