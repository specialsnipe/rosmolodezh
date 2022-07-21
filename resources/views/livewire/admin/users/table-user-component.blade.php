
    <tr @if (isset($user->deleted_at))
        class="bg-dark"
        @endif >
        <td wire:click='openMore' >{{$user->id}}</td>
        <td wire:click='openMore' ><img src="{{asset($user->avatar_thumbnail_path)}}" width=50px height=50px alt="image">
        </td>
        <td wire:click='openMore' >{{$user->all_names}}</td>
        <td wire:click='openMore' >{{$user->occupation->name}}</td>
        <td><span style="padding: 5px 10px; background: #72c07d; border-radius: 5px">{{$user->role->name}}</span>
        </td>
        <td>@forelse($user->tracks as $track) <a href="{{route('admin.tracks.show', $track->id)}}"
                style="padding: 5px 10px; background: #5ebff5; border-radius: 5px">{{$track->title}}</a>
            @empty <span>Нет траектории</span> @endforelse</td>

        @if (auth()->user()->id != $user->id)

            <td style="width: 200px" class="d-flex justify-content-end align-items-center">

                <div class="mr-2 badge
                        @if($active) badge-success @else badge-secondary @endif">
                        @if($active) Активен @else Деактивирован @endif
                </div>
                <button wire:click='changeStatus'
                    class="border-0 change-status text-center btn btn-primary"
                    >Изменить статус</button>
            </td>
        @else
            <td wire:click='openMore' style="width: 200px" class="d-flex justify-content-end align-items-center">

                <div class=" btn
                    @if($active) btn-primary @else btn-secondary @endif">
                    @if($active) Это текущий пользователь @else Деактивирован @endif
                </div>
            </td>
        @endif
    </tr>

    {{-- <tr class="expandable-body @if(!$opened) d-none @else @endif">
        <td colspan="10">
            <table class="table-head-fixed text-nowrap">
                <thead>
                    <td class="mr-3 mt-3 mb-3">логин</td>
                    <td class="mr-3 mt-3 mb-3">пол</td>
                    <td class="mr-3 mt-3 mb-3">возраст</td>
                    <td class="mr-3 mt-3 mb-3">почта</td>
                    <td class="mr-3 mt-3 mb-3">телеграм логин</td>
                    <td class="mr-3 mt-3 mb-3">телеграм id</td>
                    <td class="mr-3 mt-3 mb-3">вконтакте</td>
                    <td class="mr-3 mt-3 mb-3">информация</td>
                </thead>
                <tbody>
                    <td class="mr-3 mt-3 mb-3"><a href="{{route('admin.users.show', $user->id)}}">{{$user->login}}</a>
                    </td>
                    <td class="mr-3 mt-3 mb-3">{{$user->gender->name}} </td>
                    <td class="mr-3 mt-3 mb-3">{{$user->age}} </td>
                    <td class="mr-3 mt-3 mb-3">{{$user->tg_name}} </td>
                    <td class="mr-3 mt-3 mb-3">{{$user->tg_id}} </td>
                    <td class="mr-3 mt-3 mb-3">{{$user->tg_url}} </td>
                    <td class="mr-3 mt-3 mb-3">{{$user->about}} </td>
                </tbody>
            </table>
        </td>
    </tr> --}}
