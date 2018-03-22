@extends('user.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            <section class="content-header">
                <h1>
                    Roll Call
                </h1>
                <div class="box">
                </div>
                <form role="form" action="{{ route('roll_call.select_statistic') }}" method="post" class="form-inline">
                    {{ csrf_field() }}
                    <div class="input-group date datepicker fn" data-provide="datepicker">
                        <input type="text" class="form-control" name="month" data-date-format="yyyy/mm" value="{{ $dateTimeMonth }}">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                    <button class="btn btn-success" type="submit">Detail</button>
                </form>
            </section>
        </h1>
    </section>
    <section class="content">
        <div class="col-sm-12">
            <div class="box box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                <tr role="row">
                                    <th width="5%" class="sorting_asc text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Date</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Start time</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">End time</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total time</th>
                                </tr>
                                </thead>
                                @php
                                    $temp = 1;
                                @endphp
                                @foreach($overtimeMonths as $overtimeMonth)
                                    <tbody>
                                    <td class="text-center">{{ $temp++ }}</td>
                                    <td class="text-center">{{ $overtimeMonth->user->name }}</td>
                                    <td class="text-center">{{ $overtimeMonth->day->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ $overtimeMonth->start_time->format('H:i:s') }}</td>
                                    <td class="text-center">{{ $overtimeMonth->end_time->format('H:i:s') }}</td>
                                    <td class="text-center">{{ $overtimeMonth->total_time }}</td>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th class="text-center">General: {{ --$temp }}</th>
                                    <th></th>
                                    <th class="text-center">{{ $temp }} day</th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-center">Total: {{ $sumOvertimeMonth }} hour</th>
                                </tr>
                                </tfoot>
                            </table>
                            {{ $overtimeMonths->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('roll_call.statistic') }}" class="btn btn-success">Back</a>
        </div>
    </section>
@endsection
@section('javascript')
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm',
            monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            todayHighlight: true,
            startView: "months",
            minViewMode: "months"
        });
    </script>

@endsection
