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
                <div class="card card-default">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="form-inline" action="{{ route('roll_call.search') }}" method="post">
                            {{csrf_field()}}
                            {{ method_field('GET') }}
                            <div class=" input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                <input type="text" name="from_date" id="from_date" class="form-control filter-overtime" placeholder="From Date" />
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <div class=" input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                <input type="text" name="to_date" id="to_date" class="form-control filter-overtime" placeholder="To Date" />
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                            <div class="inline">
                                <input type="submit" name="filter" id="filter" value="Search" class="btn btn-info" />
                            </div>
                        </form>
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Start time</th>
                                <th class="text-center">End time</th>
                                <th class="text-center">Total time</th>
                                <th class="text-center">Show</th>
                            </tr>
                            </thead>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach($rollCalls as $rollCall)
                                <tbody>
                                <td class="text-center">{{ $temp++ }}</td>
                                <td class="text-center">{{ $rollCall->day->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $rollCall->start_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $rollCall->end_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $rollCall->total_time }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $rollCall->id }}">Detail</button>
                                    <div id="{{ $rollCall->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h3 class="modal-title">Absence detail</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <h4><strong>{{ $rollCall->user->name }}</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Date: {{ $rollCall->day->format('d/m/Y') }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Start time: {{ $rollCall->start_time->format('H:i:s') }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        End time: {{ $rollCall->end_time->format('H:i:s') }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Total: {{ $rollCall->total_time }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                    <a class="btn btn-success" href="{{ route('roll-call.index') }}">Back</a>
                </div>
            </div>
        </div>
    </section>
@endsection
