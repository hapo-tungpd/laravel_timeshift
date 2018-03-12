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
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{ (Auth::user()->image == null) ? asset('img/default.png') : asset('storage/'.Auth::user()->image) }}" alt="User profile picture">
                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                {{--<p class="text-muted text-center">Software Engineer</p>--}}
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Email: </b> <a class=""> {{ Auth::user()->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Birthday: </b> <a class=""> {{ (Auth::user()->birthday != null) ? Auth::user()->birthday->format('d-m-Y') : "" }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Address: </b> <a class=""> {{ Auth::user()->address }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Gender: </b> <a class=""> {{ Auth::user()->gender?"Male":"Female" }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Phone number: </b> <a class=""> {{ Auth::user()->phone }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>JLPT: </b> <a class=""> {{ Auth::user()->JLPT }}</a>
                    </li>
                </ul>
                <form method="GET">
                    {{ csrf_field() }}
                    <a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-primary btn-block"><b>Update profile</b></a>
                </form>
            </div>
        </div>
    </div>
@endsection
