@extends('user.layouts.master')

@section('content')
    <style>
        .ui-datepicker-calendar {
            display: none;
        }
    </style>
    <section class="content-header">
        <h1>
            Roll Call
        </h1>
    </section>
    <section class="content">
        <div class="box"></div>
        <form role="form" action="{{ route('roll_call.statistic') }}" method="GET" class="form-inline">
            <input type="hidden" name="_method" value="PUT">
            {{ csrf_field() }}
            <div class="input-group date datepicker fn" data-provide="datepicker">
                <input type="text" class="form-control" name="month" data-date-format="yyyy/mm" value="{{ $dateTimeMonth }}">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
            <button class="btn btn-success" type="submit">Detail</button>
        </form>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="box box-body">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                            <th class="text-center">No.</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Total Hours</th>
                            </thead>
                            <tbody>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach ($rollCalls as $rollCall)
                                <tr>
                                    <td class="text-center">{{ $temp++ }}</td>
                                    <td class="text-center">{{ $rollCall->day->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ $rollCall->total_time }} hour</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th class="text-center">Total time working</th>
                                <th class="text-center">{{ --$temp }} day</th>
                                <th class="text-center">{{ $sumRollCall }} hour</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a class="btn btn-success" href="{{ route('roll-call.index') }}">Back</a>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm',
            // todayHighlight: true,
            startView: "months",
            minViewMode: "months",
        });
    </script>

@endsection