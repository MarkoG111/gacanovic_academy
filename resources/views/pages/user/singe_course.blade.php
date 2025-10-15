@extends('layout.user')

@section('title')
@endsection

@section('content')
    @if (session()->has('user'))
        @foreach ($myLearnings as $learning)
            <?php
                $ids_learning_courses[] = $learning->id_course;
            ?>
        @endforeach
    @endif
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-12 text-center mx-auto my-5">
                <div class="single-image">
                    <img src="{{ file_exists(public_path('/img/courses/' . $course->image_small)) ? asset('/img/courses/' . $course->image_small) : asset('storage/courses/' . $course->image_small) }}" alt="webdev" class=img-fluid" />
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
                        <h4 class="py-2">Author: {{ $course->author }}</h4>
                    </div>

                    <div class="actions">
                        @if (session()->has('user'))
                            @if (session()->get('user')->id_user == 1)
                                <h4 class="text-warning">You must be logged in as User if You want to buy course.</h4>
                            @else
                                @if (isset($ids_learning_courses))
                                    @if (in_array($course->id_course, $ids_learning_courses))
                                        <h4>You already bought this course.</h4>
                                    @else
                                        <a href="javascript:void(0)" class="add-course-to-cart" data-idcourse="{{ $course->id_course }}">
                                            <i class="fas fa-shopping-cart fa-2x clr "></i><span>Add To Cart</span>
                                        </a>
                                        <a href="javascript:void(0)" class="wishhhh" data-idcourse="{{ $course->id_course }}">
                                            <i class="fas fa-heart fa-2x clr "></i><span>Add To Whishlist</span>
                                        </a>
                                    @endif
                                @else
                                    <a href="javascript:void(0)" class="add-course-to-cart" data-idcourse="{{ $course->id_course }}">
                                        <i class="fas fa-shopping-cart fa-2x clr "></i><span>Add To Cart</span>
                                    </a>
                                    <a href="javascript:void(0)" class="wishhhh" data-idcourse="{{ $course->id_course }}">
                                        <i class="fas fa-heart fa-2x clr "></i><span>Add To Whishlist</span>
                                    </a>
                                @endif
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
