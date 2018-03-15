@extends('admin.layouts.master')
@section('content')
<section class="content-header">
    <h1>
        STATISTIC SALARY FOR EMPLOYEE
        <small>advanced tables</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Salary month: </h3>
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
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th width="5%" class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
                            <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 297px;">Name</th>
                            <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 190px;">Total time working</th>
                        <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 190px;">Final Payment</th></tr>
                        </thead>
                        <tbody>
                        @php
                            $temp = 1;
                        @endphp
                        @foreach($total as $data)
                            <tbody>
                            <td class="text-center">{{ $temp++ }}</td>
                            <td class="text-center">{{ $data->name }}</td>
                            <td class="text-center">{{ $data->total_times }}</td>
                            <td class="text-center">{{ $data->total_times * 50000 }} VNĐ</td>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="text-center" rowspan="1" colspan="1">Gereral: {{ --$temp }}</th>
                                <th rowspan="1" colspan="1"></th>
                                <th rowspan="1" colspan="1"></th>
                                <th class="text-center" rowspan="1" colspan="1">Total: {{ $dataSumRollCallMonth  }} VNĐ</th></tr>
                            </tfoot>
                    </table>
                </div>
            </div>
            <div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>
    </div>
    <!-- /.box-body -->
</div>
@endsection