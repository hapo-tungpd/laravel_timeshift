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
                        <form action="{{ route('absence.create', Auth::user()->id) }}" method="GET">
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
                                <th>Type</th>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Content</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($absence as $absences)
                                <tbody>
                                <td>{{ $absences->id }}</td>
                                <td>{{ $absences->user_id }}</td>
                                <td>{{ $absences->day->format('d/m/Y') }}</td>
                                <td>{{ $absences->type?"Full time":"Part time" }}</td>
                                <td>{{ $absences->start_time->format('H:s d-m-Y') }}</td>
                                <td>{{ $absences->end_time->format('H:s d-m-Y') }}</td>
                                <td>{{ $absences->content }}</td>
                                <td>
                                    <a href="{{ route('absence.show', $absences->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-th-list"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('absence.edit', $absences->id) }}">
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('absence.destroy', $absences->id) }}" method="POST">
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
