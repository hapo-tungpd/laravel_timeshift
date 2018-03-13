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
                                <th>Type</th>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Content</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td>{{ $absence->id }}</td>
                            <td>{{ $absence->user_id }}</td>
                            <td>{{ $absence->type }}</td>
                            <td>{{ $absence->day->format('d/m/Y') }}</td>
                            <td>{{ $absence->start_time->format('H:s') }}</td>
                            <td>{{ $absence->end_time->format('H:s') }}</td>
                            <td>{{ $absence->content }}</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection