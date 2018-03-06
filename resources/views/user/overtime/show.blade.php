@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">Your Report</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Your ID</th>
                                <th>Date</th>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Total time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td>{{ $overtime->id }}</td>
                            <td>{{ $overtime->user_id }}</td>
                            <td>{{ $overtime->day->format('d/m/Y') }}</td>
                            <td>{{ $overtime->start_time->format('H:s:i') }}</td>
                            <td>{{ $overtime->end_time->format('H:s:i') }}</td>
                            <td>{{ $overtime->total_time }}</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection