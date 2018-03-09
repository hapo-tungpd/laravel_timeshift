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
                                <th class="text-center">Start time</th>
                                <th class="text-center">End time</th>
                                <th class="text-center">Total time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td class="text-center">{{ $overtime->id }}</td>
                            <td class="text-center">{{ $overtime->day->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $overtime->start_time->format('H:s:i') }}</td>
                            <td class="text-center">{{ $overtime->end_time->format('H:s:i') }}</td>
                            <td class="text-center">{{ $overtime->total_time }}</td>
                            </tbody>
                        </table>
                            <a href="{{ route('overtime.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
