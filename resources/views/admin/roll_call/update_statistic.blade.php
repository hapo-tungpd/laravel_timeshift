@extends('admin.layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Roll Call
        </h1>
    </section>
    <section class="content">
        <div class="box">
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><strong>Roll call</strong> {{ $dateTimeMonth }}</h3>
                        <form role="form" action="{{ route('admin.roll_call.statistic') }}" method="GET" class="form-inline">
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
                    </div>
                    <!-- /.box-header -->
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><strong>Roll call Of Month,</strong> {{ $dateTimeMonth }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                        <tr role="row">
                                            <th width="5%" class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 297px;">Name</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 361px;">Date</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 322px;">Start time</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 257px;">End time</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 190px;">Total time</th></tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $temp = 1;
                                        @endphp
                                        @foreach($rolCallMonths as $rolCallMonth)
                                            <tbody>
                                            <td class="text-center">{{ $temp++ }}</td>
                                            <td class="text-center">{{ $rolCallMonth->user->name }}</td>
                                            <td class="text-center">{{ $rolCallMonth->day->format('d/m/Y') }}</td>
                                            <td class="text-center">{{ $rolCallMonth->start_time->format('H:i:s') }}</td>
                                            <td class="text-center">{{ $rolCallMonth->end_time->format('H:i:s') }}</td>
                                            <td class="text-center">{{ $rolCallMonth->total_time }}</td>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th class="text-center" rowspan="1" colspan="1">Gereral: {{ --$temp }}</th>
                                                <th rowspan="1" colspan="1"></th>
                                                <th rowspan="1" colspan="1"></th>
                                                <th rowspan="1" colspan="1"></th>
                                                <th rowspan="1" colspan="1"></th>
                                                <th class="text-center" rowspan="1" colspan="1">Total: {{ $sumRollCallMonth }} hour</th></tr>
                                            </tfoot>
                                    </table>
                                    {{ $rolCallMonths->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div><div class="row docs-premium-template">
                <div class="col-sm-12 col-md-6">
                    <div class="box box-solid">
                        <div class="box-body">
                            <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                                <strong>GENERAL ROLL CALL EMPLOYEE OF MONTH,</strong> {{ $dateTimeMonth }}
                            </h4>
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th width="5%" class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 297px;">Name</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 190px;">Total time</th>
                                </thead>
                                <tbody>
                                @php
                                    $temp = 1;
                                @endphp
                                @foreach($statisticRollCallMonths as $statisticRollCallMonth)
                                    <tbody>
                                    <td class="text-center">{{ $temp++ }}</td>
                                    <td class="text-center">{{ $statisticRollCallMonth->user->name }}</td>
                                    <td class="text-center">{{ $statisticRollCallMonth->total_times }}</td>
                                    </tbody>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th class="text-center" rowspan="1" colspan="1">Gereral: {{ --$temp }}</th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th class="text-center" rowspan="1" colspan="1">Total: {{ $dataSumRollCallMonth }} hour</th>
                                </tr>
                                </tfoot>
                            </table>
                            {{ $statisticRollCallMonths -> links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div></section>
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
