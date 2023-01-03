{{-- <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/jquery.backtotop.js') }}"></script> --}}
{{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/plugins.js') }}"></script> --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.mobilemenu.js') }}"></script>

<script src="{{ asset('js/main.js') }}"></script>

@if (session()->has('user') && session()->get('user')->id_role == 2)
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/wish.js') }}"></script>
@endif

</body>

</html>
