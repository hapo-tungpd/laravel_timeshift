@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="alert alert-success">
                            <p>Login as USER</p>
                        </div>
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Member Name</th>
                                    <th>Email</th>
                                    <th>birthday</th>
                                    <th>image</th>
                                    <th>address</th>
                                    <th>gender</th>
                                    <th>phone</th>
                                    <th>JLPT</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $key => $value)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->birthday }}</td>
                                        <td>{{ $value->image }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>{{ $value->gender }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->JLPT }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection