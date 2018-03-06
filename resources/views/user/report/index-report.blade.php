@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">Welcome to Report, {{ Auth::user()->name }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('report.create', Auth::user()->id) }}" method="GET">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary ">
                                <i class="fa fa-th-list"></i>
                                Create new report
                            </button>
                        </form>
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Your ID</th>
                                <th>Date</th>
                                <th>Today</th>
                                <th>Tomorrow</th>
                                <th>Problem</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($report as $reports)
                            <tbody>
                            <td>{{ $reports->id }}</td>
                            <td>{{ $reports->user_id }}</td>
                            <td>{{ $reports->day }}</td>
                            <td>{{ $reports->today }}</td>
                            <td>{{ $reports->tomorrow }}</td>
                            <td>{{ $reports->problem }}</td>
                            <td>
                                <a href="{{ route('report.show', $reports->id) }}">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-th-list"></i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('report.edit', $reports->id) }}">
                                    <button class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('report.destroy', $reports->id) }}" method="POST">
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