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
                                <th class="text-center">ID</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Today</th>
                                <th class="text-center">Tomorrow</th>
                                <th class="text-center">Problem</th>
                            </tr>
                            </thead>
                                <tbody>
                                <td class="text-center">{{ $report->id }}</td>
                                <td class="text-center">{{ $report->day->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $report->today }}</td>
                                <td class="text-center">{{ $report->tomorrow }}</td>
                                <td class="text-center">{{ $report->problem }}</td>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection