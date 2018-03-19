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
                            <div>
                                <h3 class="text-center">Employee roll call: {{ $user->name }}</h3>
                            </div>
                            <div>
                                <h4>Date: {{ $rollCall->day->format('d-m-Y') }}.</h4>
                            </div>
                            <thead>
                            <tr>
                                <th width="15%" class="text-center">Subject</th>
                                <th class="text-center">Content</th>
                            </tr>
                            </thead>
                            <tr>
                                <tbody>
                                <td class="text-center">Day</td>
                                <td class="text-center">{{ $rollCall->day->format('d-m-Y') }}</td>
                                </tbody>
                            </tr>
                            <tr>
                                <tbody>
                                <td class="text-center">Start time</td>
                                <td class="text-center">{{ $rollCall->start_time->format('H:i d-m-Y') }}</td>
                                </tbody>
                            </tr>
                            <tr>
                                <tbody>
                                <td class="text-center">End time</td>
                                <td class="text-center">{{ $rollCall->end_time->format('H:i d-m-Y') }}</td>
                                </tbody>
                            </tr>
                            <tr>
                                <tbody>
                                <td class="text-center">Total time</td>
                                <td class="text-center">{{ $rollCall->total_time }}</td>
                                </tbody>
                            </tr>
                        </table>
                        <a href="{{ route('admin.rollcall.index') }}"><button type="button" class="btn btn-success" ><i></i>Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection