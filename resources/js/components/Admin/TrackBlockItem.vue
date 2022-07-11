<template>
    <div class="track_block">
        <div class="block_info">
            <div class="block_header">
                <h5>{{ block.id }} | {{ block.title }}</h5>

                <div class="block_text">
                    <table>
                        <tr>
                            <td>Состояние:</td>
                            <td><b>Открыт</b></td>
                        </tr>
                        <tr>
                            <td>Количество заданий:</td>
                            <td><b>{{ block.exercises_count }} заданий</b></td>
                        </tr>
                        <tr>
                            <td>Уровень освоения:</td>
                            <td><b></b></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- TODO: Сделать сслыку на block.tasks.show -->
            <a href="{{ urls.blockTaskShow }}" class="block_all">
                Задания
            </a>
            <!-- TODO: Сделать сслыку на block.show-->
            <a href="{{ urls.blockShow }}" class="block_all">
                Управление блоком
            </a>
        </div>
    </div>
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
