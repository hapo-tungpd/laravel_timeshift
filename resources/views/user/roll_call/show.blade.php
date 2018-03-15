@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">Your Roll Call</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Start Roll Call</th>
                                <th class="text-center">End Roll Call</th>
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td class="text-center">{{ $rollcall->id }}</td>
                            <td class="text-center">{{ $rollcall->start_time->format('H:i d-m-Y') }}</td>
                            <td class="text-center">{{ $rollcall->end_time->format('H:i d-m-Y') }}</td>
                            <td class="text-center">{{ $rollcall->total_time }}</td>
                            </tbody>
                        </table>
                        <a href="{{ route('rollcall.index') }}"><button type="button" class="btn btn-success" ><i></i>Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection