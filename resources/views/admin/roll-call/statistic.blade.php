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
                        <h3 class="box-title">Roll call Today, @php echo date('d/m/Y'); @endphp</h3>
                        <select class="selectpicker show-tick">
                            <option>Tháng 1</option>
                            <option>Tháng 2</option>
                            <option>Tháng 3</option>
                            <option>Tháng 4</option>
                            <option>Tháng 5</option>
                            <option>Tháng 6</option>
                            <option>Tháng 7</option>
                            <option>Tháng 8</option>
                            <option>Tháng 9</option>
                            <option>Tháng 10</option>
                            <option>Tháng 11</option>
                            <option>Tháng 12</option>
                        </select>
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
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous disabled" id="example2_previous">
                                                <a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a>
                                            </li>
                                            <li class="paginate_button active">
                                                <a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0">1</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0">2</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0">3</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0">4</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0">5</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0">6</a>
                                            </li>
                                            <li class="paginate_button next" id="example2_next">
                                                <a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Roll call Of Month, @php echo date('m/Y'); @endphp</h3>
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
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous disabled" id="example1_previous">
                                                <a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
                                            </li>
                                            <li class="paginate_button active">
                                                <a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a>
                                            </li>
                                            <li class="paginate_button ">
                                                <a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a>
                                            </li><li class="paginate_button next" id="example1_next">
                                                <a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a>
                                            </li>
                                        </ul>
                                    </div>
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
                                STATISTIC ROLL CALL EMPLOYEE TODAY, @php echo date('d-m/Y'); @endphp
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
                                STATISTIC ROLL CALL EMPLOYEE OF MONTH, @php echo date('m/Y'); @endphp
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
                                            <a href="{{ route('admin.rollcall.showRollCall', $data->user_id) }}">
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
