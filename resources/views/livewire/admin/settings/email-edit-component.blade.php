<div>

        <input class=" form-control" type="text"  value="{{$email->email}}">
        @error('email')
        <div class="text-danger">{{$message}}</div>
        @enderror
</div>
