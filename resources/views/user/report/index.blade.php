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
                                <th class="text-center">No.</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Today</th>
                                <th class="text-center">Tomorrow</th>
                                <th class="text-center">Problem</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach($report as $data)
                            <tbody>
                            <td class="text-center">{{ $temp++ }}</td>
                            <td class="text-center">{{ $data->day->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $data->today }}</td>
                            <td class="text-center">{{ $data->tomorrow }}</td>
                            <td class="text-center">{{ $data->problem }}</td>
                            <td class="text-center">
                                <a href="{{ route('report.show', $data->id) }}">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-th-list"></i>
                                    </button>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('report.edit', $data->id) }}">
                                    <button class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('report.destroy', $data->id) }}" method="POST">
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