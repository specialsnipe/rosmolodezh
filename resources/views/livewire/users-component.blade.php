<div>
    <div id="accordion" role="tablist" aria-multiselectable="true">

        <div class="card">
            <div class="card-header" role="tab" id="headingOne">
                <h5 class="mb-0">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                       aria-expanded="true"
                       aria-controls="collapseOne">
                        Фильтр по пользователям
                    </a>
                </h5>
            </div>


            {{ $first_name }} <br>
            {{ $last_name }}<br>
            {{ implode(' - ', $role_id) }}
            {{ implode(' - ', $track_id) }}
            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                <div class="card-block pt-2 pl-3">
                    <div class="form-group mr-3">
                        <div style="display: flex;">
                            <div class="mr-3">
                                <label for="last_name">Фамилия</label>
                                <input type="text"
                                        wire:model="last_name"
                                        class="form-control mb-2"
                                        id="last_name"
                                        placeholder="Фамилия">
                            </div>

                            <div class="mr-3">
                                <label for="first_name">Имя</label>
                                <input value="{{request()->first_name}}"
                                        wire:model="first_name"
                                        name="first_name"
                                        class="form-control mb-2"
                                        id="first_name"
                                        placeholder="Имя">
                            </div>
                            <div class="mr-3">
                                <label for="father_name">Отчество</label>
                                <input value="{{request()->father_name}}"
                                        wire:model="father_name"
                                        name="father_name"
                                        class="form-control mb-2"
                                        id="father_name"
                                        placeholder="Отчество">
                            </div>

                            <div class="mr-3">
                                <label>Роль</label>
                                <ul>

                                    @foreach($roles as $role)
                                        <li>
                                            <input type="checkbox" wire:model="role_id"value="{{$role->id}}">
                                            <span>{{$role->name}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mr-3">
                                <label>Траектория</label>
                                <ul>

                                    @foreach($tracks as $track)
                                        <li>
                                            <input type="checkbox" wire:model="track_id" value="{{$track->id}}">
                                            <span>{{$track->title}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>ID</th>
                <th>Логин</th>
                <th>Аватар</th>
                <th>ФИО</th>
                <th>Занятость</th>
                <th>Пол</th>
                <th>Возраст</th>
                <th>Роль</th>
                <th>Майл</th>
                <th>Траектория</th>
                <th>Телеграм</th>
                <th>Вконтакте</th>
                <th>Комментарий</th>
            </tr>
            </thead>
            <tbody>
                {{-- {{  $users }} --}}
            @forelse ($users as $user)

                <tr>
                    <td>{{$user->id}}</td>
                    <td><a href="{{route('admin.users.show', $user->id)}}">{{$user->login}}</a></td>
                    <td><img src="{{asset($user->avatar_thumbnail_path)}}" width=50px height=50px
                                alt="image"></td>
                    <td style="display: flex; flex-direction: column">
                        <span>
                            {{$user->last_name}}
                        </span>
                        <span>
                            {{$user->first_name}}
                        </span>
                        <span>
                            {{$user->father_name}}
                        </span>
                    </td>
                    <td>{{$user->occupation->name}}</td>
                    <td>{{$user->gender->name}}</td>
                    <td>{{$user->age}}</td>
                    <td><span style="padding: 5px 10px; background: #72c07d; border-radius: 5px">{{$user->role->name}}</span></td>
                    <td>{{$user->email}}</td>
                    <td>@forelse($user->tracks as $track) <a href="{{route('admin.tracks.show', $track->id)}}" style="padding: 5px 10px; background: #5ebff5; border-radius: 5px">{{$track->title}}</a> @empty <span>Нет траектории</span> @endforelse</td>
                    <td>{{$user->tg_url}}</td>
                    <td>{{$user->vk_url}}</td>
                    <td>{{$user->about}}</td>
                </tr>
                @empty
                <tr>
                    <td></td>
                    <td>Пользователей нет</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
