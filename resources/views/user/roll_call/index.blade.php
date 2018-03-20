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
                                <th width="10%" class="text-center">Show</th>
                                <th width="10%" class="text-center">Status</th>
                            </tr>
                            </thead>
                            @php
                                $temp = 1;
                            @endphp
                                <tbody>
                                <td class="text-center">{{ $temp++ }}</td>
                                <td class="text-center">{{ $rollCalls->day->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $rollCalls->start_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $rollCalls->end_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $rollCalls->total_time }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $rollCalls->id }}">Detail</button>
                                    <div id="{{ $rollCalls->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h3 class="modal-title">Absence detail</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <h4><strong>{{ $rollCalls->user->name }}</strong></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Date: {{ $rollCalls->day->format('d/m/Y') }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Start time: {{ $rollCalls->start_time->format('H:i:s') }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        End time: {{ $rollCalls->end_time->format('H:i:s') }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Total: {{ $rollCalls->total_time }}
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
                                    <a href="{{ route('roll-call.edit', $rollCalls->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="">End working</i>
                                        </button>
                                    </a>
                                </td>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection