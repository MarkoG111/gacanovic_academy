@extends('layout.user')

@section('title')
    Contact
@endsection

@section('content')
    <div class="wrapper row3">
        <main class="hoc container clear">
            <div class="content">
                <div id="comments">

                    <h2>Write To Us</h2>
                    <div id="contact_form">
                        @csrf
                        <div class="one_third first">
                            <label for="email">Mail <span>*</span></label>
                            @if (session()->has('user'))
                                <input type="email" name="email" id="email" value="{{ session()->get('user')->email }}"
                                    size="22" required>
                                <small id="emailHelp" class="form-text text-danger"></small>
                            @else
                                <input type="email" name="email" id="email" value="" size="22" required>
                                <small id="emailHelp" class="form-text text-danger"></small>
                            @endif
                        </div>
                        <div class="one_third">
                            <label for="subject">Subject <span>*</span></label>
                            <input type="text" name="subject" id="subject" value="" size="22" required>
                            <small id="subjectHelp" class="form-text text-danger"></small>
                        </div>
                        <div class="block clear">
                            <label for="message">Your Message</label>
                            <textarea name="message" id="message" cols="25" rows="10"></textarea>
                            <small id="messageHelp" class="form-text text-danger"></small>
                        </div>
                        <div>
                            <input type="submit" name="submit" id="submitContact" value="Submit Form">
                            &nbsp;
                            <input type="reset" name="reset" id="resetContact" value="Reset Form">
                        </div>
                    </div>

                    <div id="successMessage" class="alert invisible" role="alert">
                        <p class="text-center font-weight-light" id="msg"></p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        {{ session()->get('error') }}
                    @endif

                    @if (session()->has('message'))
                        {{ session()->get('message') }}
                    @endif
                </div>
            </div>
            <div class="clear"></div>
        </main>
    </div>
@endsection
