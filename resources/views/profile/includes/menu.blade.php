<aside class="col-sm-12 col-md-3 profile-aside">
    <ul class="nav nav-pills nav-sidebar flex-column">
        <li class="nav-item">
            <a href="{{ route('profile.progress') }}" class="nav-link
            @if(request()->routeIs('profile.progress')) active @endif
            ">Главная</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('profile.data') }}" class="nav-link
            @if(request()->routeIs('profile.data')) active @endif
            ">Персональные данные</a>
        </li>
    </ul>
    <h4 class="h4 col-12 ">Ваши направления:</h4>
    <ul class="nav nav-pills nav-sidebar flex-column">

        @if(auth()->user()->role->name === 'tutor' || auth()->user()->role->name === 'teacher' )
        @foreach (auth()->user()->tracksWhereTeacher as $track)
        <li class="nav-item">
            <a href="{{ route('profile.track.show', $track->id) }}" class="nav-link
                @if(request()->is('profile/progress/track/'. $track->id)) active @endif
                @if(request()->is('profile/tracks/'. $track->id . '/blocks/create')) active @endif
                ">
                {{ $track->title }}
                @if($track->curator_id === auth()->user()->id) <i class="fa fa-flag"></i> @endif
            </a>
        </li>
        @endforeach
        @else
        @foreach (auth()->user()->tracks as $track)
        <li class="nav-item">
            <a href="{{ route('profile.user.track.show', $track->id) }}" class="nav-link
                @if(request()->is('profile/progress/user/track/'. $track->id)) active @endif
                ">{{ $track->title }}</a>
        </li>
            @endforeach
        @endif

    </ul>
    @if(auth()->user()->tracks->where('curator_id', auth()->user()->id)->count() >= 1)
        <h4 class="h4 col-12 ">Направления где вы руководитель:</h4>
        <ul class="nav nav-pills nav-sidebar flex-column">
            @foreach (auth()->user()->tracks->where('curator_id', auth()->user()->id) as $track)
            <li class="nav-item">
                <a href="{{ route('profile.track.show', $track->id) }}" class="nav-link
                @if(request()->is('profile/progress/track/'. $track->id)) active @endif
                @if(request()->is('profile/tracks/'. $track->id . '/blocks/create')) active @endif
                ">{{ $track->title }}</a>
            </li>
            @endforeach
        </ul>
    @endif
</aside>
