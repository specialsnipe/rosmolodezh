<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    @stack('seo')
    <title>Росмолодежь. Обучение</title>
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel='stylesheet' id='roboto-subset.css-css'
        href='https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5'
        type='text/css' media='all' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    {{--
    <link rel="stylesheet" href="{{ asset('css/media.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/css/simple-adaptive-slider.min.css') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/favicon.ico') }}">

    {{-- <script data-cfasync="false">
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        '//www.googletagmanager.com/gtm.'+'js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-W7MBMN');
    </script> --}}
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/scripts/simple-adaptive-slider.min.js') }}"></script>
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-lite.min.css')}}">
    <script src="{{ asset('plugins/summernote/summernote-lite.min.js') }}"></script>
    @stack("styles")
</head>

<body>
    <header>
        @include('includes.menu')
    </header>

    <main>
        @yield('flash')
        @yield('content')
    </main>

    <footer>
        @include('includes.footer')
    </footer>

    <button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
        <i class="fas fa-chevron-up"></i>
    </button>
    <script src="{{ asset('scripts/script.js') }}"></script>

    <script src="https://kit.fontawesome.com/dd4e721722.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    @stack("script")

</body>

</html>
