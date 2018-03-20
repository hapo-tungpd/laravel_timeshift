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
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Start Roll Call</th>
                                <th class="text-center">End Roll Call</th>
                                <th class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td class="text-center">{{ $rollcall->id }}</td>
                            <td class="text-center">{{ $rollcall->start_time->format('H:i d-m-Y') }}</td>
                            <td class="text-center">{{ $rollcall->end_time->format('H:i d-m-Y') }}</td>
                            <td class="text-center">{{ $rollcall->total_time }}</td>
                            </tbody>
                        </table>
                        <a href="{{ route('roll_call.show_all_roll_call') }}"><button type="button" class="btn btn-success" ><i></i>Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection