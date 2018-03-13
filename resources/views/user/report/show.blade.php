@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">Information your report</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <div>
                                <h3 class="text-center">Writer: {{ $user->name }}</h3>
                            </div>
                            <div>
                                <h4>Date: {{ $report->day->format('d-m-Y') }}.</h4>
                            </div>
                            <thead>
                            <tr>
                                <th width="15%" class="text-center">Subject</th>
                                <th class="text-center">Content</th>
                            </tr>
                            </thead>
                            <tr>
                                <tbody>
                                <td class="text-center">Today</td>
                                <td>{{ $report->today }}</td>
                                </tbody>
                            </tr>
                            <tr>
                                <tbody>
                                <td class="text-center">Tomorrow</td>
                                <td>{{ $report->tomorrow }}</td>
                                </tbody>
                            </tr>
                            <tr>
                                <tbody>
                                <td class="text-center">Problem</td>
                                <td>{{ $report->problem }}</td>
                                </tbody>
                            </tr>
                        </table>
                        <a href="{{ route('report.index') }}"><button type="button" class="btn btn-success" ><i></i>Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection