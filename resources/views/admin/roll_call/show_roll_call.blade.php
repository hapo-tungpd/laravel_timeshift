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
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr role="row">
                                <th width="8%" class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 297px;">Name</th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 297px;">Date</th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 297px;">Start time</th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 297px;">End time</th>
                                <th class="sorting text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 190px;">Total time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach($rollCallEmployee as $data)
                                <tbody>
                                <td class="text-center">{{ $temp++ }}</td>
                                <td class="text-center">{{ $data->user->name }}</td>
                                <td class="text-center">{{ $data->day->format('d-m-Y') }}</td>
                                <td class="text-center">{{ $data->start_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $data->end_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $data->total_time }}</td>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="text-center" rowspan="1" colspan="1">Gereral: {{ $countRollCall }} day</th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th rowspan="1" colspan="1"></th>
                                    <th class="text-center" rowspan="1" colspan="1">Total: {{ $dataSumRollCallMonth }} hour</th></tr>
                                </tfoot>
                        </table>
                        {{ $rollCallEmployee->links() }}
                        <a href="{{ route('admin.roll_call.statistic') }}"><button type="button" class="btn btn-success" ><i></i>Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection