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
                        <h3 class="box-title"><strong>Roll call Today,</strong> @php echo date('d/m/Y'); @endphp</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6">
                                </div>
                            </div>
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
                                            <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total time</th></tr>
                                        </thead>

                                        @php
                                            $temp = 1;
                                        @endphp
                                        @foreach($rollCallDay as $data)
                                            <tbody>
                                            <td class="text-center">{{ $temp++ }}</td>
                                            <td class="text-center">{{ $data->user->name }}</td>
                                            <td class="text-center">{{ $data->day->format('d/m/Y') }}</td>
                                            <td class="text-center">{{ $data->start_time->format('H:i:s') }}</td>
                                            <td class="text-center">{{ $data->end_time->format('H:i:s') }}</td>
                                            <td class="text-center">{{ $data->total_time }}</td>
                                        @endforeach
                                        <tfoot>
                                        <tr>
                                            <th class="text-center" rowspan="1" colspan="1">General: {{ --$temp }}</th>
                                            <th rowspan="1" colspan="1"></th>
                                            <th rowspan="1" colspan="1"></th>
                                            <th rowspan="1" colspan="1"></th>
                                            <th rowspan="1" colspan="1"></th>
                                            <th class="text-center" rowspan="1" colspan="1">Total: {{ $sumRollCallToday }} hour</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    {{ $rollCallDay->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><strong>Roll call Of Month,</strong> @php echo date('m/Y'); @endphp</h3>
                        <form role="form" action="{{ route('admin.roll_call.update_statistic') }}" method="post">
                            {{ csrf_field() }}
                            <select class="selectpicker show-tick" name="month">
                                <option value="2018-01" {{ ($dateTimeMonth == '2018-01')?'selected':'' }}>Tháng 1</option>
                                <option value="2018-02" {{ ($dateTimeMonth == '2018-02')?'selected':'' }}>Tháng 2</option>
                                <option value="2018-03" {{ ($dateTimeMonth == '2018-03')?'selected':'' }}>Tháng 3</option>
                                <option value="2018-04" {{ ($dateTimeMonth == '2018-04')?'selected':'' }}>Tháng 4</option>
                                <option value="2018-05" {{ ($dateTimeMonth == '2018-05')?'selected':'' }}>Tháng 5</option>
                                <option value="2018-06" {{ ($dateTimeMonth == '2018-06')?'selected':'' }}>Tháng 6</option>
                                <option value="2018-07" {{ ($dateTimeMonth == '2018-07')?'selected':'' }}>Tháng 7</option>
                                <option value="2018-08" {{ ($dateTimeMonth == '2018-08')?'selected':'' }}>Tháng 8</option>
                                <option value="2018-09" {{ ($dateTimeMonth == '2018-09')?'selected':'' }}>Tháng 9</option>
                                <option value="2018-10" {{ ($dateTimeMonth == '2018-10')?'selected':'' }}>Tháng 10</option>
                                <option value="2018-11" {{ ($dateTimeMonth == '2018-11')?'selected':'' }}>Tháng 11</option>
                                <option value="2018-12" {{ ($dateTimeMonth == '2018-12')?'selected':'' }}>Tháng 12</option>
                            </select>
                            <button class="btn btn-success" type="submit">Submit</button>
                        </form>
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
                                        @foreach($rolCallMonth as $data)
                                            <tbody>
                                            <td class="text-center">{{ $temp++ }}</td>
                                            <td class="text-center">{{ $data->user->name }}</td>
                                            <td class="text-center">{{ $data->day->format('d/m/Y') }}</td>
                                            <td class="text-center">{{ $data->start_time->format('H:i:s') }}</td>
                                            <td class="text-center">{{ $data->end_time->format('H:i:s') }}</td>
                                            <td class="text-center">{{ $data->total_time }}</td>
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
                                    {{ $rolCallMonth->links() }}
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
                                <strong>GENERAL ROLL CALL EMPLOYEE TODAY,</strong> @php echo date('d-m/Y'); @endphp
                            </h4>
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th width="5%" class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 297px;">Name</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 190px;">Total time</th></tr>
                                </thead>
                                <tbody>
                                @php
                                    $temp = 1;
                                @endphp
                                @foreach($dataName as $data)
                                    <tbody>
                                    <td class="text-center">{{ $temp++ }}</td>
                                    <td class="text-center">{{ $data->user->name }}</td>
                                    <td class="text-center">{{ $data->total_times }}</td>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th class="text-center" rowspan="1" colspan="1">Gereral: {{ --$temp }}</th>
                                        <th rowspan="1" colspan="1"></th>
                                        <th class="text-center" rowspan="1" colspan="1">Total: {{ $dataSumRollCallToDay }} hour</th></tr>
                                    </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="box box-solid">
                        <div class="box-body">
                            <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                                <strong>GENERAL ROLL CALL EMPLOYEE OF MONTH,</strong> @php echo date('m/Y'); @endphp
                            </h4>
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th width="5%" class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 297px;">Name</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 190px;">Total time</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 25px;">Show</th></tr>
                                </thead>
                                <tbody>
                                @php
                                    $temp = 1;
                                @endphp
                                @foreach($dataNameMonth as $data)
                                    <tbody>
                                        <td class="text-center">{{ $temp++ }}</td>
                                        <td class="text-center">{{ $data->user->name }}</td>
                                        <td class="text-center">{{ $data->total_times }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.roll_call.show_roll_call', $data->user_id) }}">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-th-list"></i>
                                                </button>
                                            </a>
                                        </td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div></section>
@endsection
