@extends('layout.user')

@section('title')
    Courses
@endsection

@section('content')
    <section class="product-section section mt-90 mb-40">
        <div class="container">
            <form action="{{ route('courses') }}" method="GET">
                @csrf
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-12 mb-50 order-lg-2 ">
                        <div class="row mb-50 pl-br">
                            <div class="col pl-br">
                                <div class="shop-top-bar with-sidebar">
                                    <div class="product-sort">
                                        <p>Sort by:</p>
                                        <select name="sort" class="form-control">
                                            @php $sort = [ ['value' => 'date', 'title' => 'Newest Courses'], ['value' => 'priceAsc', 'title' => 'Price: low to high'], ['value' => 'priceDesc', 'title' => 'Price: high to low'] ] @endphp
                                            @foreach ($sort as $s)
                                                @if ($s['value'] == $sort)
                                                    <option selected value="{{ $s['value'] }}">{{ $s['title'] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $s['value'] }}">{{ $s['title'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="product-search mt-t align-self-center">
                                        <footer>
                                            <form class="example" action="">
                                                <input type="text" placeholder="Search For Courses" aria-label="true"
                                                    name="search" class="form-control" value="{{ $search }}">
                                                <button type="submit" class="buttonS"><i class="fa fa-search"></i></button>
                                            </form>
                                        </footer>
                                    </div>
                                    <div class="product-showing">
                                        <p>Showing:</p>
                                        <select name="showing" id="showing" class="form-control">
                                            @php $show = [ ['value' => '6',], ['value' => '9',],['value' => '12',],['value' => '15'] ] @endphp
                                            @foreach ($show as $s)
                                                @if ($s['value'] == $showing)
                                                    <option selected value="{{ $s['value'] }}">{{ $s['value'] }}
                                                    </option>
                                                @else
                                                    <option value="{{ $s['value'] }}">{{ $s['value'] }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                    <p class="align-self-center">Pages: {{ $courses->currentPage() }} of
                                        {{ $courses->lastPage() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="shop-product-wrap grid with-sidebar row">

                            @foreach ($courses as $course)
                                @component('components.single_course', [
                                    'course' => $course,
                                    ])
                                @endcomponent
                            @endforeach

                            @if (!count($courses))
                                <h2>No courses for specific request. Try another.</h2>
                            @endif
                        </div>
                        <div class="row mt-30">
                            <div class="col">
                                {{ $courses->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <div class="shop-sidebar-wrap col-xl-3 col-lg-4 col-12 mb-15 order-lg-1">
                        <div class="shop-sidebar mb-40">
                            <h4 class="text-center pb-5 pt-2">TOPIC</h4>
                            @foreach ($topics as $topic)
                                <div class="col-12 mb-15 position-relative">
                                    @if (in_array($topic->id_topic, $topicChb ?? []))
                                        <input type="checkbox" name="topic[]" id="remember_me"
                                            value="{{ $topic->id_topic }}" checked />
                                        <label for="remember_me">{{ $topic->topic_name }}</label>
                                    @else
                                        <input type="checkbox" name="topic[]" id="remember_me"
                                            value="{{ $topic->id_topic }}" />
                                        <label for="remember_me">{{ $topic->topic_name }}</label>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="shop-sidebar mb-40">
                            <h4 class="text-center pb-5 pt-2">CATEGORY</h4>
                            @foreach ($categories as $c)
                                <div class="col-12 mb-15 position-relative">
                                    @if (in_array($c->id_category, $categoriesChb ?? []))
                                        <input type="checkbox" name="categories[]" id="remember_me" checked="checked"
                                            value="{{ $c->id_category }}">
                                        <label for="remember_me">{{ $c->category_name }}</label>
                                    @else
                                        <input type="checkbox" name="categories[]" id="remember_me"
                                            value="{{ $c->id_category }}">
                                        <label for="remember_me">{{ $c->category_name }}</label>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
