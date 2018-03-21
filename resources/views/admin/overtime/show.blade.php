@extends('admin.layouts.master')

@section('content')

    <section class="content-header">
        <h1>
            Overtime
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
                        <strong>{{ $user->name }}, </strong> {{ $overTime->day->format('d-m-Y') }}
                                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr role="row">
                                        <th width="10%" class="sorting_asc text-center" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Start time</th>
                                        <th width="10%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">End time</th>
                                        <th width="10%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Total</th>
                                        <th width="70%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Report</th>
                                    </thead>
                                    <tbody>
                                        <tbody>
                                        <td class="text-center">{{ $overTime->start_time->format('H:i:s') }}</td>
                                        <td class="text-center">{{ $overTime->end_time->format('H:i:s') }}</td>
                                        <td class="text-center">{{ $overTime->total_time }} hour</td>
                                        <td class="">{{ $overTime->content }}</td>
                                        </tbody>
                                </table>
                            <a href="{{ route('admin.overtime.index') }}"><button type="button" class="btn btn-success" ><i></i>Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection