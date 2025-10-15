@extends('layout.user')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title mb-4">My Learnings</h2>

                @if (session()->get('user')->id_role == 2)
                    @if ($myLearnings->isEmpty())
                        <h2 class="text-danger">No courses in your learning section.</h2>
                    @else
                        <div class="row">
                            @foreach ($myLearnings as $learning)
                                <div class="col-sm-6 col-md-3">
                                    <input type="hidden" name="hiddenIdCourse" id="{{ $learning->id_course }}" value="{{ $learning->id_course }}">

                                    <div class="image-course-info">
                                        <img src="{{ file_exists(public_path('/img/courses/' . $course->image_small)) ? asset('/img/courses/' . $course->image_small) : asset('storage/courses/' . $course->image_small) }}"
                                            alt="webdev" class=learning-img" />                                    
                                    </div>
                                    <div class="headings-course-info">
                                        <p><span>Bought At: </span> {{ $learning->bought_at }}</p>
                                        <p>{{ $learning->description }}</p>
                                        <p><span>Price: </span> {{ $learning->price }} &euro;</p>
                                        <p><span>Author: </span> {{ $learning->author }}</p>
                                    </div>
                                    <div class="stats-course-info">
                                        <p class="lessons-heading"><span>Lessons: </span> </p>
                                        @foreach ($lessons as $lesson)
                                            @if ($lesson->id_course == $learning->id_course)
                                                <a href="{{ $lesson->lesson }}" target="_blank"> <p>- {{ $lesson->lesson }}</p> </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
@endsection
