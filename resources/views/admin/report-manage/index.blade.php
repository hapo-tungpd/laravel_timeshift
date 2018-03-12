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
                                <th width="3%" class="text-center">No.</th>
                                <th width="8%" class="text-center">Name</th>
                                <th width="8%" class="text-center">Date</th>
                                <th width="25%" class="text-center">Today</th>
                                <th width="25%" class="text-center">Tomorrow</th>
                                <th width="25%" class="text-center">Problem</th>
                                <th width="5%" class="text-center"></th>
                            </tr>
                            </thead>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach($report as $data)
                                <tbody>
                                <td class="text-center">{{ $temp++ }}</td>
                                <td class="text-center">{{ $data->user->name }}</td>
                                <td>{{ $data->day->format('d-m-Y') }}</td>
                                <td>{{ str_limit($data->today, 60) }}</td>
                                <td>{{ str_limit($data->tomorrow, 60) }}</td>
                                <td>{{ str_limit($data->problem, 60) }}</td>
                                <td>
                                    <a href="{{ route('admin.report.show', $data->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-th-list"></i>
                                        </button>
                                    </a>
                                </td>
                                </tbody>
                            @endforeach
                        </table>
                        {{ $report->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
