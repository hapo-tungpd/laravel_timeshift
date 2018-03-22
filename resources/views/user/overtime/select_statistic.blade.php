@extends('user.layouts.master')
@section('content')
    <section class="content-header">
        <h1>
            <section class="content-header">
                <h1>
                    Your Overtime
                </h1>
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
                                    <th width="15%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                                    <th width="10%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Date</th>
                                    <th width="10%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Start time</th>
                                    <th width="10%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">End time</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Report</th>
                                    <th width="10%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total time</th></tr>
                                </thead>
                                @php
                                    $temp = 1;
                                @endphp
                                @foreach($overtimeMonth as $data)
                                    <tbody>
                                    <td class="text-center">{{ $temp++ }}</td>
                                    <td class="text-center">{{ $data->user->name }}</td>
                                    <td class="text-center">{{ $data->day->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ $data->start_time->format('H:i:s') }}</td>
                                    <td class="text-center">{{ $data->end_time->format('H:i:s') }}</td>
                                    <td>{{ $data->content }}</td>
                                    <td class="text-center">{{ $data->total_time }}</td>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th class="text-center" rowspan="1" colspan="1">General:</th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th class="text-center" rowspan="1" colspan="1">Total: {{ $sumOvertimeMonth }} hour</th>
                                </tr>
                                </tfoot>
                            </table>
                            {{ $overtimeMonth->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="box box-solid">
                        <div class="box-body">
                            <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                                <strong>GENERAL OVERTIME OF MONTH,</strong> @php echo date('m/Y'); @endphp
                            </h4>
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th width="5%" class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 297px;">Name</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 190px;">Date</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 190px;">Total time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $temp = 1;
                                @endphp
                                @foreach($dataNameMonth as $data)
                                    <tbody>
                                    <td class="text-center">{{ $temp++ }}</td>
                                    <td class="text-center">{{ Auth::user()->name }}</td>
                                    <td class="text-center">{{ $data->day->format('d-m-Y') }}</td>
                                    <td class="text-center">{{ $data->total_times }}</td>
                                    </tbody>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th class="text-center" rowspan="1" colspan="1">Gereral</th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th class="text-center" rowspan="1" colspan="1">{{ --$temp }} day</th>
                                    <th class="text-center" rowspan="1" colspan="1">Total: {{ $sumOvertimeMonth }} hour</th>
                                </tr>
                                </tfoot>
                            </table>
                            {{ $dataNameMonth->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('overtime.statistic') }}" class="btn btn-success">Back</a>
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