@extends('layouts.main')
@push('style')
    @livewireStyles
    <link rel="stylesheet" href="{{  asset('css/exercise-styles.css') }}">
@endpush

@section('content')
    <div class="container p-0">
        <div class="main-container-directions">
    @livewire('exercise-edit-component', ['block' => $block, 'exercise'=> $exercise])
    </div>
    </div>
@endsection
@push('script')

    @livewireScripts
@endpush
