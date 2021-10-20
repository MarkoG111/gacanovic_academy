<!DOCTYPE html>
<html lang="en">

@include('fixed.admin.head')

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        @include('fixed.admin.header')
        @include('fixed.admin.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

    </div>

    @include('fixed.admin.footer')

    @yield('scripts')
</body>

</html>
