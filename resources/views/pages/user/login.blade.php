@extends('layout.user')

@section('title')
Login
@endsection

@section('content')
    <div class="row">

        <div class="col-xs-12 col-lg-6 mx-auto" id="loginReg">

            <div class="panel panel-login">

                <div class="panel-heading">

                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Register</a>
                        </div>
                    </div>

                    <hr>

                </div>

                <div class="panel-body">

                    <div class="row">

                        <div class="col-lg-12">

                            <form id="login-form" action="{{ route('doLogin') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Username">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3 mx-auto">
                                            <input type="submit" name="login-submit" id="login-submit"
                                                class="form-control authBtn btn-login" value="Login">
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <form id="register-form" action="" method="post" style="display: none;">

                                <div class="form-group">
                                    <input type="email" name="emailReg" id="emailReg" class="form-control"
                                        placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="usernameReg" id="usernameReg" class="form-control"
                                        placeholder="Username">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="passwordReg" id="passwordReg" class="form-control"
                                        placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="passwordRegConf" id="passwordRegConf" class="form-control"
                                        placeholder="Repeat password">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3 mx-auto ">
                                            <input type="button" name="register-submit" id="register-submit"
                                                class="form-control authBtn btn-register" value="Register">
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div id="notification">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(session()->has('error'))
                                    {{ session()->get('error') }}
                                @endif
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
