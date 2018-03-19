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
                <form role="form" action="{{ route('rollcall.selectStatistic') }}" method="post">
                    {{ csrf_field() }}
                    <select class="selectpicker show-tick" name="month">
                        <option value="2018-01" {{ ($dateTimeMonth == '2018-01')?'selected':'' }}>January</option>
                        <option value="2018-02" {{ ($dateTimeMonth == '2018-02')?'selected':'' }}>February</option>
                        <option value="2018-03" {{ ($dateTimeMonth == '2018-03')?'selected':'' }}>March</option>
                        <option value="2018-04" {{ ($dateTimeMonth == '2018-04')?'selected':'' }}>April</option>
                        <option value="2018-05" {{ ($dateTimeMonth == '2018-05')?'selected':'' }}>May</option>
                        <option value="2018-06" {{ ($dateTimeMonth == '2018-06')?'selected':'' }}>June</option>
                        <option value="2018-07" {{ ($dateTimeMonth == '2018-07')?'selected':'' }}>July</option>
                        <option value="2018-08" {{ ($dateTimeMonth == '2018-08')?'selected':'' }}>August</option>
                        <option value="2018-09" {{ ($dateTimeMonth == '2018-09')?'selected':'' }}>September</option>
                        <option value="2018-10" {{ ($dateTimeMonth == '2018-10')?'selected':'' }}>October</option>
                        <option value="2018-11" {{ ($dateTimeMonth == '2018-11')?'selected':'' }}>November</option>
                        <option value="2018-12" {{ ($dateTimeMonth == '2018-12')?'selected':'' }}>December</option>
                    </select>
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
                                @foreach($overtimeMonth as $data)
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
                                    <th class="text-center" rowspan="1" colspan="1">{{ $temp }} day</th>
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
            </div>
            <a href="{{ route('overtime.statistic') }}" class="btn btn-success">Back</a>
        </div>
    </section>
@endsection
