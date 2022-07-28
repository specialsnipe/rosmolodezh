@extends('layouts.main')

@section('content')


@guest
<x-registration-form></x-registration-form>
@endguest
@endsection

