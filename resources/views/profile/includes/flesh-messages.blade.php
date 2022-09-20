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
