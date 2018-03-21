@extends('user.layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Overtime
        </h1>
    </section>
    <section class="content">
        <div class="box">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th width="10%" class="text-center">Date</th>
                                <th width="15%" class="text-center">Start time</th>
                                <th width="15%" class="text-center">End time</th>
                                <th width="15%" class="text-center">Total time</th>
                                <th class="text-center">Report</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td class="text-center">{{ $overtime->day->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $overtime->start_time->format('H:s:i') }}</td>
                            <td class="text-center">{{ $overtime->end_time->format('H:s:i') }}</td>
                            <td class="text-center">{{ $overtime->total_time }} hours</td>
                            <td>{{ $overtime->content }}</td>
                            </tbody>
                        </table>
                        <a href="{{ route('overtime.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection