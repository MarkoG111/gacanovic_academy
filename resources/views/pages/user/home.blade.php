@extends('layout.user')

@section('title')
    Home
@endsection

@section('content')
    <div class="wrapper row2">
        <section class="hoc container clear">

            <div class="sectiontitle fl_left">
                <h2 class="subtitle">Course Categories</h2>
            </div>
            <ul class="nospace group prices">
                @foreach ($categories as $c)
                    <li class="one_third">
                        <article>
                            <div class="image-cat">
                                <img src="{{ asset("img/categories/" . $c->category_image) }}" alt="{{ $c->category_name }}" />
                            </div>
                            <h6 class="heading"><a
                                    href="{{ route('courses', ['categories[]' => $c->id_category]) }}">{{ $c->category_name }}</a>
                            </h6>
                            <p>From: <sup></sup><strong><?= rand(20, 80) ?></strong><em>&euro;</em></p>
                        </article>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>

    <div class="wrapper coloured">
        <article class="hoc cta clear">

            <h6 class="three_quarter first subscribeTitle">SUBSCRIBE OUR NEWSLETTER</h6>
            <footer class="one_quarter">
                <form class="example" action="">
                    <input type="text" placeholder="Enter Your Email" aria-label="true" name="search">
                    <button type="submit">SUB</button>
                </form>
            </footer>
        </article>
    </div>
@endsection
