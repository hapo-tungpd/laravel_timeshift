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
                                <th>Today</th>
                                <th>Tomorrow</th>
                                <th>Problem</th>
                            </tr>
                            </thead>
                                <tbody>
                                <td>{{ $report->id }}</td>
                                <td>{{ $report->user_id }}</td>
                                <td>{{ $report->day->format('d/m/Y') }}</td>
                                <td>{{ $report->today }}</td>
                                <td>{{ $report->tomorrow }}</td>
                                <td>{{ $report->problem }}</td>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection