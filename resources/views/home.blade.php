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
                                <th width="5">No.</th>
                                <th>Member Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $value)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <a href="{{ url('/home/information') }}" class="badge badge-primary text-center button">Show Information</a>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
