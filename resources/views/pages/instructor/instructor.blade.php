@extends('layout.instructor')

@section('content')
    <div class="header-instructor">
        <div class="row">
            <div class="col-6">
                <img src="{{ asset('/img/logo-learnings.png') }}" class="img-fluid" />
            </div>
            <div class="col-6 flex-link">
                <a class="exit-url" href="{{ url('/') }}">Exit</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 center-text-instructor">
                <h2 class="section-title mb-4" id="poll-heading">Please Select Answer to Start Teaching.</h2>
            </div>
        </div>
    </div>
    <div class="container wp">
        <div class="row">
            <div class="col-12">
                <form action="" method="PUT" role="form" id="poll-instructor">
                    <p>What kind of teaching have you done before?</p>

                    @foreach ($answers as $ans)
                        <label class="form-control">
                            <input type="radio" name="teachingAns" value="{{ $ans->id_answer }}" /> {{ $ans->answer }}
                        </label>
                    @endforeach

                    <input type="hidden" name="idUser" id="hdnIdUsr" value="{{ $user->id_user }}">
                    <button type="button" id="btnVote" class="btn btn-success mt-30 mb-50">Become a Instructor</button>
                </form>

                <div id="votingRes">

                </div>

                <a href="" id="btnCreateCourse" class="btn btn-primary mt-30 mb-50">Go To Create Your Course!</a>
            </div>
        </div>
    </div>
@endsection
