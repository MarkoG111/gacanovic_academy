@extends('layout.user')

@section('title')

@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-12 text-center mx-auto my-5">
                <div class="single-image">
                    <img src="{{ asset('/img/courses/' . $course->image_big) }}" class="img-fluid"
                        alt="{{ $course->course_name }}">
                </div>
            </div>
            <div class="col-md-6 col-12 text-md-left text-center">
                <div class="contentT">
                    <div class="titles">
                        <p><span>Category :</span> <span class="cat">{{ $course->category_name }}</span></p>
                        <h2>{{ $course->course_name }}</h2>
                    </div>
                    <div class="numbers py-5">
                        <h4 class="price">Price: {{ $course->price }} &euro;</h4>
                        <h4 class="hours">Total hours: {{ floatval($course->total_hours) }}</h4>
                    </div>

                    <div class="actions">
                        @if (session()->has('user'))
                            @if (session()->get('user')->id_user == 1)
                                <h4 class="text-warning">You must be logged in as User if You want to buy course.</h4>
                            @else
                                <a href="#" class="add-to-cart" data-idcourse="{{ $course->id_course }}"><i
                                        class="fas fa-shopping-cart fa-2x clr "></i><span>Add To Cart</span></a>
                                <a href="#" class="wishhhh" data-idcourse="{{ $course->id_course }}"><i
                                        class="fas fa-heart fa-2x clr "></i><span>Add To Whishlist</span></a>
                            @endif
                        @else
                            <h4 class="text-warning">You must be logged in if You want to buy course.</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
