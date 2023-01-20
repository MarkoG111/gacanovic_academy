<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.mobilemenu.js') }}"></script>

<script src="{{ asset('js/main.js') }}"></script>

@if (session()->has('user') && session()->get('user')->id_role == 2)
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/wish.js') }}"></script>
@endif

</body>

</html>
