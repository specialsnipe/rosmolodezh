@extends('layouts.main')

@section('content')

        @auth
            Этот пользователь авторизован {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
        @endauth
@endsection
