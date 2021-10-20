<div class="wrapper row4">
    <footer id="footer" class="hoc clear">

        <div class="one_half first">
            <h6 class="heading">CATEGORIES</h6>
            <ul class="nospace linklist">
                @foreach ($categories as $c)
                    <li>
                        <article>
                            <p class="nospace btmspace-10"><a
                                    href="{{ route('courses', ['categories[]' => $c->id_category]) }}">{{ $c->category_name }}</a>
                            </p>
                        </article>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="one_half">
            <h6 class="heading">PAGES</h6>
            <ul class="nospace linklist">
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
        </div>

    </footer>
</div>

<div class="wrapper row5">
    <div id="copyright" class="hoc clear">
        <p class="fl_left">&copy; Copyright, <a href="{{ route('author') }}">Marko Gačanović 38 / 17</a> &nbsp; &
            &nbsp; <a href="{{ asset('dokumentacija.pdf') }}">Documentation</a> </p>

        <p class="fl_right">Template by <a target="_blank" href="https://www.os-templates.com/"
                title="Free Website Templates">OS Templates</a></p>
    </div>
</div>

{{-- <a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a> --}}
