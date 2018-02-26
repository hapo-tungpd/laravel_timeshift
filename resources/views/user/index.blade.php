@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">Welcome to HapoERP, {{ Auth::user()->name }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('user.users.edit', Auth::user()->id) }}" method="GET">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary ">
                                <i class="fa fa-th-list"></i>
                                EDIT PROFILE
                            </button>
                        </form>
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Birthday</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>JLPT</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <td>{{ Auth::user()->id }}</td>
                                    {{--<td>{{ Auth::user()->image }}--}}
                                    <td><img width="50" src="{{ asset('img/'.Auth::user()->image) }}" class="img-home" alt=""></td>
                                    <td>{{ Auth::user()->name }}</td>
                                    <td>{{ Auth::user()->email }}</td>
                                    <td>{{ Auth::user()->birthday }}</td>
                                    <td>{{ Auth::user()->address }}</td>
                                    <td>{{ Auth::user()->gender }}</td>
                                    <td>{{ Auth::user()->phone }}</td>
                                    <td>{{ Auth::user()->JLPT }}</td>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection