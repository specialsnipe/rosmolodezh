<template>
    <div class="track_container">
        <div class="tack_header">
            <h2><a href="{{ route('admin.tracks.show', $track->id) }}"> Направление "{{ $track->title }}" </a></h2>
            <div class="track_manage_tab">
                <a href="{{ route('admin.tracks.show', $track->id) }}"> <i class="fa fa-eye"></i></a>
                <a href="{{ route('admin.tracks.edit', $track->id) }}">Изменить <i class="fa fa-pen"></i></a>
                {{-- TODO: Сделать модальное окно подтверждения об удалении с подтвержением пароля пользователя --}}
                <a href="#">Удалить <i class="fa fa-trash"></i></a>
            </div>
        </div>
        <div class="tack_info">
            <div class="track_image">
                <img src="{{ asset($track->image_original) }}" alt="дизайн" height="150px">
            </div>
            <table class="tack_text track_table">
                <tr>
                    <td>Куратор направления: </td>
                    <td><a href="{{ route('admin.users.show', $track->curator_id) }}">{{ $track->curator->all_names }}</a></td>
                </tr>
                <tr>
                    <td>Количество блоков: </td>
                    <td>{{ $track->blocks_count }} блоков</td>
                </tr>
                <tr>
                    <td>Всего обучающихся: </td>
                    <td>{{ $track->users_count }} человек</td>
                </tr>
                <tr>
                    <td>Успеваемость:  </td>
                    <td><span class="status_block status_success">100%</span></td>
                </tr>
                <tr>
                    <td>Средний балл: </td>
                    <td><span class="status_block status_success">4.7</span></td>
                </tr>
            </table>
        </div>
        <div class="track_blocks hidden" style="display: none;">
            @forelse($track->blocks as $block)
            <div class="track_block">
                <div class="block_info">
                    <div class="block_header">
                        <h5>{{ $block->id }} | {{ $block->title }}</h5>

                        <div class="block_text">
                            <table>
                                <tr>
                                    <td>Состояние:</td>
                                    <td><b>Открыт</b></td>
                                </tr>
                                <tr>
                                    <td>Количество заданий:</td>
                                    <td><b>15 заданий</b></td>
                                </tr>
                                <tr>
                                    <td>Уровень освоения:</td>
                                    <td><b>Простой</b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{-- TODO: Сделать сслыку на block.tasks.show  ? --}}
                    <a href="#" class="block_all">
                        Задания
                    </a>
                    {{-- TODO: Сделать сслыку на block.show --}}
                    <a href="#" class="block_all">
                        Управление блоком
                    </a>
                </div>
            </div>
            @empty
            <div class="track_block">

                <h5>Блоков у этого направления ещё нет</h5>
            </div>
            @endforelse
            {{-- TODO: Сделать сслыку на добавление блока--}}
            <a class="btn btn-success" style="width: 100%; height: 40px;">  <i class="fa fa-plus"></i> Добавить новый блок </a>

        </div>

        <div class="open_blocks"><img src="{{ asset('images/arrow.png') }}" alt="Открыть блок" width="30px"></div>
    </div>
    @empty
    <h2>Направления ещё не созданы</h2>
    @endforelse
</template>

<script>
export default {
    name: "AdminBlockItem",
    props: {
        block: Array,
        urls: Array
    }
}
</script>

<style scoped>

</style>
