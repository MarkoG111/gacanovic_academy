<body id="top">

    <div class="wrapper row0">
        <div id="topbar" class="hoc clear">
            <div class="fl_left">

                <ul class="nospace">
                    <li><a href="#"><img src="{{ asset('img/avatar.png') }}" alt="avatar" /></a></li>
                    <p>My Account</p>
                    @if (session()->has('user'))
                        <p>{{ session()->get('user')->username }}</p>
                    @endif
                </ul>

            </div>
            <div class="fl_right">

                <ul class="nospace">
                    <li><a href="{{ url('/wishlist') }}" title="Your Whishlist"><i class="fas fa-heart fa-2x"></i>
                            @if (session()->has('user')) <span class="number"
                                    id="numberOfWishes">0</span>@endif
                        </a></li>
                    <li><a href="{{ url('/cart') }}" title="Your Cart"><i class="fas fa-shopping-cart fa-2x"></i>
                            @if (session()->has('user'))<span class="number"
                                    id="numberInCart">0</span>@endif
                        </a></li>
                </ul>

            </div>
        </div>
    </div>

    <div class="wrapper row1">
        <header id="header" class="hoc clear">
            <div id="logo" class="fl_left">
                <h1><a href="">Gačanović Academy</a></h1>
            </div>
            <nav id="mainav" class="fl_right">
                <ul class="clear">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('courses') }}">Courses</a></li>
                    <li><a href="{{ route('contactPage') }}">Contact</a></li>

                    @if (!session()->has('user'))
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @else
                        @if (session()->has('user') && session()->get('user')->id_role == 1)
                            <li><a href="{{ route('logs') }}">Admin</a></li>
                        @endif
                        <li><a href="{{ url('/orders') }}">Orders</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    @endif
                </ul>
            </nav>
        </header>
    </div>
