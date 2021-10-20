<div class="col-xl-4 col-md-6 col-12 pb-30 pt-10 pr-25">
    <div class="product {{ $course->id_course }}">
        <img src="{{ asset('/img/courses/' . $course->image_small) }}" alt="webdev" class="img-fluid" />
        <div class="content">
            <div class="text-desc">
                <h4 class="title"><a
                        href="{{ url('courses', ['id' => $course->id_course]) }}">{{ $course->course_name }}</a>
                </h4>
                <a href="{{ route('courses', ['categories[]' => $course->id_category]) }}"
                    class="category">Development</a>
            </div>
            <div class="course-price">
                <p class="pricee">&euro; {{ $course->price }} </p>
                <p>{{ floatval($course->total_hours) }} hours</p>
                <div class="iconsFa">
                    @if (session()->has('user') && session()->get('user')->id_role == 1)
                        
                    @else
                        <a href="#" class="add-to-cart" data-idcourse="{{ $course->id_course }}"><i
                                class="fas fa-shopping-cart fa-2x clr"></i></a>
                        <a href="#" class="wishhhh" data-idcourse="{{ $course->id_course }}"><i
                                class="fas fa-heart fa-2x clr"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
