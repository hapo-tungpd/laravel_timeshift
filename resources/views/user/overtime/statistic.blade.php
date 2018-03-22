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
        <form role="form" action="{{ route('overtime.selectStatistic') }}" method="GET" class="form-inline">
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
            <div class="col-xs-12">
                <div class="box box-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                            <th width="15%" class="text-center">No.</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Total Hours</th>
                            </thead>
                            <tbody>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach ($overtime as $data)
                                <tr>
                                    <td class="text-center">{{ $temp++ }}</td>
                                    <td class="text-center">{{ $data->day->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ $data->total_time }} hour</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th class="text-center">Total time OT</th>
                                <th></th>
                                <th class="text-center">{{ $sumOvertime }} hours</th>
                            </tr>
                            </tbody>
                        </table>
                    <a href="{{ route('overtime.index') }}" class="btn btn-success">Back</a>
                </div>
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