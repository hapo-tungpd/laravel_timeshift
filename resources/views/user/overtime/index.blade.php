@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">Welcome to Overtime, {{ Auth::user()->name }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('overtime.create', Auth::user()->id) }}" method="GET">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary ">
                                <i class="fa fa-th-list"></i>
                                Create new Overtime
                            </button>
                        </form>
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Your ID</th>
                                <th>Date</th>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Total time</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($overtime as $overtimes)
                                <tbody>
                                <td>{{ $overtimes->id }}</td>
                                <td>{{ $overtimes->user_id }}</td>
                                <td>{{ $overtimes->day->format('d/m/Y') }}</td>
                                <td>{{ $overtimes->start_time->format('H:s:i') }}</td>
                                <td>{{ $overtimes->end_time->format('H:s:i') }}</td>
                                <td>{{ $overtimes->total_time }}</td>
                                <td>
                                    <a href="{{ route('overtime.show', $overtimes->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-th-list"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('overtime.edit', $overtimes->id) }}">
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('overtime.destroy', $overtimes->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="fa fa-trash-o btn btn-danger btn-sm"></button>
                                    </form>
                                </td>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
