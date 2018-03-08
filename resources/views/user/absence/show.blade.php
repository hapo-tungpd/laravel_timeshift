@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">Your Absence</div>
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
                                <th class="text-center">Type</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Start time</th>
                                <th class="text-center">End time</th>
                                <th class="text-center">Content</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td class="text-center">{{ $absence->id }}</td>
                            <td class="text-center">
                                @if ($absence->type == 1)
                                    Fulltime
                                @elseif ($absence->type == 2)
                                    Parttime
                                @else
                                    Other
                                @endif
                            </td>
                            <td class="text-center">{{ $absence->day->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $absence->start_time->format('H:s') }}</td>
                            <td class="text-center">{{ $absence->end_time->format('H:s') }}</td>
                            <td class="text-center">{{ $absence->content }}</td>
                            </tbody>
                        </table>
                        <a class="btn btn-primary" href="{{ route('absence.index') }}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection