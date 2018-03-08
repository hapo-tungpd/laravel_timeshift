@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">
                        <select class="selectpicker show-tick">
                            <option>Tháng 1</option>
                            <option>Tháng 2</option>
                            <option>Tháng 3</option>
                            <option>Tháng 4</option>
                            <option>Tháng 5</option>
                            <option>Tháng 6</option>
                            <option>Tháng 7</option>
                            <option>Tháng 8</option>
                            <option>Tháng 9</option>
                            <option>Tháng 10</option>
                            <option>Tháng 11</option>
                            <option>Tháng 12</option>
                        </select>
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
                                        <th class="text-center">{{ $sum_overtime }} hour</th>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection