<div class="col-xl-4 col-md-6 col-12 pb-30 pt-10 pr-25">
    <div class="product {{ $course->id_course }}">
      <img src="{{ file_exists(public_path('/img/courses/' . $course->image_small)) ? asset('/img/courses/' . $course->image_small) : asset('storage/courses/' . $course->image_small) }}"
            alt="webdev" class="img-fluid" />
        
        <div class="content">
            <div class="text-desc">
                <h4 class="title">
                    <a href="{{ url('courses', ['id' => $course->id_course]) }}">{{ $course->course_name }}</a>
                </h4>
                <a href="{{ route('courses', ['categories[]' => $course->id_category]) }}"
                    class="category">{{ $course->category_name }}</a>
            </div>

            <div class="course-price">
                <p class="pricee">&euro; {{ $course->price }} </p>
                <p>{{ floatval($course->total_hours) }} hours</p>
                <p>Author: {{ $course->author }}</p>

                <div class="iconsFa">
                    @if (session()->has('user'))
                        @if (isset($ids_learning_courses))
                            @if (session()->has('user') && in_array($course->id_course, $ids_learning_courses))
                                <p>You already bought this course.</p>
                            @else
                                <a href="javascript:void(0)" class="add-course-to-cart"
                                    data-idcourse="{{ $course->id_course }}">
                                    <i class="fas fa-shopping-cart fa-2x clr"></i>
                                </a>
                                <a href="javascript:void(0)" class="wishhhh" data-idcourse="{{ $course->id_course }}">
                                    <i class="fas fa-heart fa-2x clr"></i>
                                </a>
                            @endif
                        @else
                            <a href="javascript:void(0)" class="add-course-to-cart"
                                data-idcourse="{{ $course->id_course }}">
                                <i class="fas fa-shopping-cart fa-2x clr"></i>
                            </a>
                            <a href="javascript:void(0)" class="wishhhh" data-idcourse="{{ $course->id_course }}">
                                <i class="fas fa-heart fa-2x clr"></i>
                            </a>
                        @endif
                    @else
                        <a href="javascript:void(0)" class="alert-item-cart">
                            <i class="fas fa-shopping-cart fa-2x clr"></i>
                        </a>
                        <a href="javascript:void(0)" class="alert-item-wish">
                            <i class="fas fa-heart fa-2x clr"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
