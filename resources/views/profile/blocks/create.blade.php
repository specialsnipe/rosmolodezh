@extends('profile.layouts.main')

@section('title') Создание блока, для направления "{{ $track->title }}" @endsection

@section('profile_content')
<form action="{{route('profile.tracks.blocks.store',$track->slug)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-sm-12 col-md-6 flex-column">
            <label for="title">Название блока</label>
            <input type="text" class="form-control " id="title" name="title" placeholder="Название"
                value="{{old('title')}}">
            @error('title')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group col-sm-12 col-md-6 flex-column">
            <label for="date_start">Дата начала блока</label>
            <input type="date" class="form-control" name="date_start" value="{{old('date_begin', date('Y-m-d'))}}">
            @error('date_start')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group col-sm-12 flex-column">
            <label for="summernote">Текст блока</label>
            <textarea id="summernote" name="body">{{old('body')}}</textarea>
            @error('body')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
    <hr>
    <div class="form-group mb-3">
        <div class="row">
            <div class="col-sm-12 col-md-4 text-right">
                <img src="" class="w-100 rounded img-fluid img-thumbnail mb-2 preview_image" height="100"
                    alt="Превью изображения блока">
            </div>

            <div class="col-sm-12 col-md-6">
                <label for="exampleInputFile2">Загрузите изображение блока</label>
                <input type="file" class="form-control custom-file-input w-100" name="image" id="exampleInputFile2"
                    value="{{old('image')}}" multiple>
                @error('image')
                <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
        </div>
    </div>

    <input type="submit" class="btn btn-primary" value="Добавить">
</form>
@endsection
@push('script')

<script defer>
    $('#summernote').summernote({
        tabsize: 2,
        height: 200,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
    let input = document.querySelector('.custom-file-input');
    let preview = document.querySelector(".preview_image")
    input.addEventListener('change', function(event) {
        if(event.target.files.length > 0){
            let src = URL.createObjectURL(event.target.files[0]);
            preview.src = src;
            preview.style.display = "block";
        }
    })

    preview.addEventListener('click', function () {
        input.click();
    })
</script>
@endpush
