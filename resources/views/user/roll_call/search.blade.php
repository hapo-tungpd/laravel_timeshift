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
                    <legend class="text-center">Roll call</legend>
                    @if(session('info'))
                        {{session('info')}}
                    @endif
                    <table class="table table-primary table-hover text-center table-show">
                        <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Start time</th>
                            <th class="text-center">End time</th>
                            <th class="text-center">Total time</th>
                            <th class="text-center"></th>
                        </tr>
                        </thead>
                        <tbody class="tbody-show">
                        @php
                            $temp = 1;
                        @endphp
                        @if(count($employees) > 0)
                            @foreach($employees as $employee)
                                <tr class="table-primary tr-show">
                                    <td class="text-center">{{ $temp++ }}</td>
                                    <td class="text-center">{{ $employee->day->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ $employee->start_time->format('H:i:s') }}</td>
                                    <td class="text-center">{{ $employee->end_time->format('H:i:s') }}</td>
                                    <td class="text-center">{{ $employee->total_time }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('roll-call.show', $employee->id) }}">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-th-list"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <th>General</th>
                            <th>{{ (count($employees)) }} day</th>
                            <th></th>
                            <th></th>
                            <th>{{ $sumTime }} hour</th>
                        </tr>
                        </tbody>
                    </table>
                    <form action="{{ route('roll-call.index') }}">
                        {{ csrf_field() }}
                        <button class="btn btn-primary">BACK</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
