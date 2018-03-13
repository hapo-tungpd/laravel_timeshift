@extends('admin.layouts.master')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Overtime Today</h3>
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
                                            <th class="sorting_asc text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Date</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Start time</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">End time</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total time</th></tr>
                                        </thead>

                                        @php
                                            $temp = 1;
                                        @endphp
                                        @foreach($overTimeDay as $data)
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
                                            <th rowspan="1" colspan="1"></th><th rowspan="1" colspan="1"></th>
                                            <th rowspan="1" colspan="1"></th>
                                            <th class="text-center" rowspan="1" colspan="1">Total: {{ $sumOverTimeToday }}</th>
                                        </tr>
                                        </tfoot>
                                    </table>
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
                        <h3 class="box-title">Overtime Of Month</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 297px;">No.</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 361px;">Date</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 322px;">Start time</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 257px;">End time</th>
                                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 190px;">Total time</th></tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $temp = 1;
                                            @endphp
                                            @foreach($overTimeMonth as $data)
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
                                        <tr><th class="text-center" rowspan="1" colspan="1">Gereral: {{ --$temp }}</th><th rowspan="1" colspan="1"></th><th rowspan="1" colspan="1"></th><th rowspan="1" colspan="1"></th><th class="text-center" rowspan="1" colspan="1">Total: {{ $sumOverTimeMonth }}</th></tr>
                                        </tfoot>
                                    </table>
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
                                STATISTIC OVERTIME EMPLOYEE
                            </h4>
                            <div class="media">
                                <div class="media-left">
                                    <a href="https://themequarry.com/theme/ample-admin-the-ultimate-dashboard-template-ASFEDA95" class="ad-click-event">
                                        <img src="https://themequarry.com/storage/images/approved/ASFEDA95_v2.1_5a0eaa448e2d5.png" alt="Ample Admin" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="clearfix">
                                        <p class="pull-right">
                                            <a href="https://themequarry.com/theme/ample-admin-the-ultimate-dashboard-template-ASFEDA95" class="btn btn-success btn-sm ad-click-event">
                                                LEARN MORE
                                            </a>
                                        </p>

                                        <h4 style="margin-top: 0">Ample Admin ─ $24</h4>

                                        <p>Admin + Frontend Template</p>
                                        <p style="margin-bottom: 0">
                                            <i class="fa fa-shopping-cart margin-r5"></i> 100+ purchases
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="box box-solid">
                        <div class="box-body">
                            <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                                PREMIUM TEMPLATE
                            </h4>
                            <div class="media">
                                <div class="media-left">
                                    <a href="https://themequarry.com/theme/appzia-responsive-admin-dashboard-ASFEDAAB" class="ad-click-event">
                                        <img src="https://themequarry.com/storage/images/approved/ASFEDAAB_v1.0.0_5992c3326c307.png" alt="Appzia" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <div class="clearfix">
                                        <p class="pull-right">
                                            <a href="https://themequarry.com/theme/appzia-responsive-admin-dashboard-ASFEDAAB" class="btn btn-success btn-sm ad-click-event">
                                                LEARN MORE
                                            </a>
                                        </p>

                                        <h4 style="margin-top: 0">Appzia ─ $18</h4>

                                        <p>Responsive Admin Dashboard</p>
                                        <p style="margin-bottom: 0">
                                            <i class="fa fa-shopping-cart margin-r5"></i> 9+ purchases
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div></section>
@endsection