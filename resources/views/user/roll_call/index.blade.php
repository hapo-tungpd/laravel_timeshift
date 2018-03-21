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
                        <div class="row">
                            <form class="form-inline my-2 my-lg-0 table table-hover table-bordered" action="{{ route('roll-call.index') }}" method="post">
                                {{csrf_field()}}
                                {{ method_field('GET') }}
                                <div class="col-md-3">
                                    <input type="text" name="search_time" id="from_date" class="form-control filter-overtime over-time-picker" placeholder="Enter Date" />
                                </div>
                                <div class="col-md-5">
                                    <input type="submit" name="filter" id="filter" value="Search" class="btn btn-info" />
                                </div>
                            </form>
                        </div>

                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th width="5%" class="text-center">No.</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Start time</th>
                                <th class="text-center">End time</th>
                                <th class="text-center">Total time</th>
                                <th width="10%" class="text-center">Show</th>
                                <th width="10%" class="text-center">Status</th>
                            </tr>
                            </thead>
                            @php
                                $temp = 1;
                            @endphp
                                <tbody>
                                <td class="text-center">{{ $temp++ }}</td>
                                <td class="text-center">{{ $rollCallToDay->day->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $rollCallToDay->start_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $rollCallToDay->end_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $rollCallToDay->total_time }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $rollCallToDay->id }}">Detail</button>
                                    <div id="{{ $rollCallToDay->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h3 class="modal-title">Roll Call detail</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <h4><strong>{{ $rollCallToDay->user->name }}</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Date: {{ $rollCallToDay->day->format('d/m/Y') }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Start time: {{ $rollCallToDay->start_time->format('H:i:s') }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        End time: {{ $rollCallToDay->end_time->format('H:i:s') }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Total: {{ $rollCallToDay->total_time }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('roll-call.edit', $rollCallToDay->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="">Roll Call Now</i>
                                        </button>
                                    </a>
                                </td>
                                </tbody>
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
                                <td class="text-center">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="">End Roll Call</i>
                                    </button>
                                </td>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection