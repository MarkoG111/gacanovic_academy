@extends('layout.admin')

@section('content')
     <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit User</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ url("/admin/users/{$user->id_user}") }}" method="POST" role="form">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Enter username" value="{{ $user->username }}" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter email" value="{{ $user->email }}" />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" class="form-control"
                                    placeholder="Enter password" />
                            </div>
                            <div class="form-group">
                                <label for="active">Active</label> <br/>
                                <input type="checkbox" name="active" id="active" value="1" @if ($user->active == 1) checked @endif>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" name="role" id="role">
                                    <option value="0">Choose</option>
                                    @foreach ($roles as $role)
                                        @if ($user->id_role == $role->id_role)
                                            <option selected value="{{ $role->id_role }}">{{ $role->role_name }}</option>
                                        @else
                                            <option value="{{ $role->id_role }}">{{ $role->role_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="hiddenUserField" value="{{ $user->id_user }}">

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="EditUser">Edit User</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="js-notification"></div>
                        @if ($errors->any())
                            <div class="alert alert-danger pr mt-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table id="table" class="table table-bordered table-hover table-responsive">

                        </table>
                        <div class="dataTables_paginate paging_simple_numbers" id="table_paginate">

                        </div>
                        <div class="msgCrud">
                            @if (session()->has('updateMsg'))
                                {{ session()->get('updateMsg') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
