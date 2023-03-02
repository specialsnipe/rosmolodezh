@php
    use App\Models\Information;
@endphp
@if(session()->has('message'))
    <div class="container p-0">

        <div class="alert alert-success alert-dismissible fade show w-100 m-0 mt-4" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
@if(session()->has('error'))
    <div class="container p-0">

        <div class="alert alert-danger alert-dismissible fade show w-100 m-0 mt-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
@if(session()->has('info'))
    <div class="container p-0">

        <div class="alert alert-info alert-dismissible fade show w-100 m-0 mt-4" role="alert">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(!isset(auth()->user()->tg_id))

<div class="container p-0">

    <div class="alert alert-light border alert-dismissible fade show w-100 m-0 mt-4" role="alert">
        @if(!isset(auth()->user()->tg_name))
        Вы не указали в личном кабинете ваш Телеграм username, мы не сможем отправлять вам сообщения если вы этого не сделаете, пожалуйста укажите его в <a target="_blank" href="{{ route('profile.data') }}">в настройках профиля</a>
        @else
        @php
        $information = Information::all()->first();
        @endphp
        Вы не зашли в бота. Для того чтобы иметь возможность получать сообщения от учителей и кураторов. <a target="_blank" href="{{ $information->tg_bot_url }}"><i class="fa-sharp fa-solid fa-arrow-up-right-from-square"></i> Перейти на бота</a>
        @endif

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
