@extends('user.layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Roll Call
        </h1>
    </section>
    <section class="content">
        <div class="box"></div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="box box-body">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">No.</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Start time</th>
                                <th class="text-center">End time</th>
                                <th class="text-center">Total time</th>
                                <th width="10%" class="text-center">Status</th>
                            </tr>
                            </thead>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach($rollCallToDays as $rollCallToDay)
                            <tbody>
                            <td class="text-center">{{ $temp++ }}</td>
                            <td class="text-center">{{ $rollCallToDay->day->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $rollCallToDay->start_time->format('H:i:s') }}</td>
                            <td class="text-center">{{ $rollCallToDay->end_time->format('H:i:s') }}</td>
                            <td class="text-center">{{ $rollCallToDay->total_time }}</td>
                            <td class="text-center">
                                @if($rollCallToDay->total_time >= 8)
                                    <a class="fa fa-check-square-o fa-fw w3-margin-right w3-xxlarge w3-text-teal"></a>
                                @else
                                    <a class="fa fa-close fa-fw w3-margin-right w3-xxlarge w3-text-teal"></a>
                                @endif
                            </td>
                            @endforeach
                        </table>
                    </div>
                </div>
                <a href="{{ route('roll-call.index') }}" class="btn btn-success">Back</a>
            </div>
        </div>
    </section>
@endsection