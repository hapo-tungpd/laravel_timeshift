@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">Welcome to Absence, {{ Auth::user()->name }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class=" row form-inline my-2 my-lg-0" action="{{ route('rollcall.search') }}" method="post">
                            {{csrf_field()}}
                            {{ method_field('GET') }}
                            <div class="col-md-3">
                                <input type="text" name="from_date" id="from_date" class="form-control filter-overtime" placeholder="From Date" />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="to_date" id="to_date" class="form-control filter-overtime" placeholder="To Date" />
                            </div>
                            <div class="col-md-5">
                                <input type="submit" name="filter" id="filter" value="Search" class="btn btn-info" />
                            </div>
                        </form>
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Start time</th>
                                <th class="text-center">End time</th>
                                <th class="text-center">Total time</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach($rollcall as $data)
                                <tbody>
                                <td class="text-center">{{ $temp++ }}</td>
                                <td class="text-center">{{ $data->day->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $data->start_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $data->end_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $data->total_time }}</td>
                                <td class="text-center">
                                    <a href="{{ route('rollcall.show', $data->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-th-list"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('rollcall.edit', $data->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="">Update time</i>
                                        </button>
                                    </a>
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