@extends('admin.layouts.main')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/track_styles.css') }}">
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Траектории</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active">Траектории</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="col-4 mt-3 mb-3">
                    <a href="{{route('admin.users.create')}}"
                       class="btn btn-block btn-primary">Добавить новую траекторию</a>
                </div>
                <div class="card-body table-responsive p-3">

                        @forelse($tracks as $track)
                        <div class="track_container">
                            <div class="tack_header">
                                <h2>Направление "{{ $track->title }}"</h2>
                            </div>
                            <div class="tack_info">
                                <div class="track_image">
                                    <img src="{{ asset($track->image_original) }}" alt="дизайн" height="150px">
                                </div>
                                <table class="tack_text">
                                    <tr>
                                        <td>Куратор направления:</td>
                                        <td>{{ $track->curator->all_names }}</td>
                                    </tr>
                                    <tr>
                                        <td>Количество блоков:</td>
                                        <td>12 блоков</td>
                                    </tr>
                                    <tr>
                                        <td>Всего обучающихся:</td>
                                        <td>56 человек</td>
                                    </tr>
                                    <tr>
                                        <td>Успеваемость:</td>
                                        <td><span class="status_block status_success">100%</span></td>
                                    </tr>
                                    <tr>
                                        <td>Средний балл:</td>
                                        <td><span class="status_block status_success">4.7</span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="track_blocks hidden" style="display: none;">
                                @forelse($track->blocks as $block)
                                    <div class="track_block">
                                        <div class="block_image">
                                            <img src="" alt="" width="100%">
                                        </div>
                                        <div class="block_info">
                                            <div class="block_header">
                                                <h5> {{ $block->title }}</h5>

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
                                                            <td>Дата открытия:</td>
                                                            <td><b>{{ $block->date_start }}</b></td>
                                                        </tr>
                                                    </table>
                                                    <table>
                                                        <tr>
                                                            <td>Уровень освоения:</td>
                                                            <td><b>Простой</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Дата закрытия:</td>
                                                            <td><b>{{ $block->date_end }}</b></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <a href="#" class="block_all">
                                                Посмотреть все задания этого блока
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="track_block">
                                        <div class="block_image">
                                            <img src="" alt="" width="100%">
                                        </div>
                                        <div class="block_info">
                                            <div class="block_header">
                                                <h5> Начальные знания в дизайне. Изучение форм, размеров и цвета</h5>

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
                                                            <td>Дата открытия:</td>
                                                            <td><b>10.07.2022</b></td>
                                                        </tr>
                                                    </table>
                                                    <table>
                                                        <tr>
                                                            <td>Уровень освоения:</td>
                                                            <td><b>Простой</b></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Дата закрытия:</td>
                                                            <td><b>11.07.2022</b></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <a href="#" class="block_all">
                                                Посмотреть все задания этого блока
                                            </a>
                                        </div>
                                    </div>
                                @endforelse
                            </div>

                            <div class="open_blocks"><img src="{{ asset('images/arrow.png') }}" alt="Открыть блок" width="30px"></div>
                        </div>
                            @empty
                                <tr>
                                    <td></td>
                                    <td>Постов нет</td>
                                </tr>
                            </tbody>
                        @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".open_blocks").each(function () {
                $(this).click(function () {
                    $(this).toggleClass('arrow-top')
                    $(this).parent().children('.hidden').slideToggle("slow");
                })
            });
        });
    </script>
@endpush
