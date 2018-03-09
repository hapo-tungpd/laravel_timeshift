@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">Welcome to Report</div>
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
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($report as $reports)
                                <tbody>
                                <td>{{ $reports->id }}</td>
                                <td>{{ $reports->user_id }}</td>
                                <td>{{ $reports->report_date }}</td>
                                <td>{{ $reports->today }}</td>
                                <td>{{ $reports->tomorrow }}</td>
                                <td>{{ $reports->problem }}</td>
                                <td>
                                    <a href="{{ route('admin_report.report.show', $reports->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-th-list"></i>
                                        </button>
                                    </a>
                                </td>

                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection