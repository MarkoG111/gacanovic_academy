@include('fixed.user.head')

@include('fixed.user.header')
@include('fixed.user.banner')

@yield('content')

@include('fixed.user.footer')

<?php if (strpos($_SERVER['REQUEST_URI'], 'contact') !== false) :?>
    <script src="{{ asset('js/contact.js') }}"></script>
<?php endif ?>

@include('fixed.user.scripts')


