@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">

                        <form action="{{ route('overtime.statistic') }}" method="POST">

                        </form>


                        <h3 class="text-center">Overtime month @php echo date('m/Y') @endphp</h3>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                            <th class="text-center">No.</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Total Hours</th>
                            </thead>
                            <tbody>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach ($overtime as $data)
                                <tr>
                                    <td class="text-center">{{ $temp++ }}</td>
                                    <td class="text-center">{{ $data->day->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ $data->total_time }} hour</td>
                                </tr>
                            @endforeach
                            <tr>
                                <th class="text-center">Total time OT</th>
                                <th class="text-center">{{ --$temp }} day</th>
                                <th class="text-center">{{ $sumOvertime }} hour</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('overtime.index') }}" class="btn btn-success">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection