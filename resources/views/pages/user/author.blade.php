@extends('layout.user')

@section('title')
    Author
@endsection

@section('content')
    <div class="container">
        <h2 class="section-title mb-4">Author</h2>
        <div class="row">
            <div class="col-6">
                <div id="author_image">
                    <img src="{{ asset('img/marko.jpg') }}" alt="author" />
                </div>
            </div>
            <div class="col-6">
                <div id="author_info">
                    <p class="textAurhor">My name is Marko Gačanović, 23 years old</p>
                    <p class="college">Student of ICT College of Vocational Studies, Information Technology course. <br/><br/>
                        Index number : 38 / 17</p>

                </div>
            </div>
        </div>
    </div>
@endsection
