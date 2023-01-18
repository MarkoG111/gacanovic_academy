<head>
    <title>@yield('title')</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin_lite.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/data_tables.min.css') }}" />
    <link href="{{ asset('fontawesome/css/fontawesome-all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet" type="text/css" />

    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>

