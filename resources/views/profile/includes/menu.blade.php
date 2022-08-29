<aside class="col-sm-12 col-md-3 profile-aside">
    <ul>
        <li>
            <a href="{{ route('profile.data') }}">Персональные данные</a>
        </li>
        <li>
            <a href="{{ route('profile.progress') }}">Профиль</a>
        </li>
    </ul>
    <h4 class="h4 col-12 ">Ваши направления:</h4>
    <ul class="track-list">
        @foreach (auth()->user()->tracks as $track)
        <li> <a href="{{ route('profile.user.track.show', $track->id) }}">{{ $track->title }}</a></li>
        @endforeach
    </ul>
    @if(auth()->user()->tracks->where('curator_id', auth()->user()->id)->count() >= 1)
        <h4 class="h4 col-12 ">Направления где вы руководитель:</h4>
        <ul class="track-list">
            @foreach (auth()->user()->tracks->where('curator_id', auth()->user()->id) as $track)
            <li> <a href="{{ route('profile.track.show', $track->id) }}">{{ $track->title }}</a></li>
            @endforeach
        </ul>
    @endif
</aside>
