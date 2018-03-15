@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">Information your absence</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <div>
                                <h3 class="text-center">Writer: {{ $user->name }}</h3>
                            </div>
                            <div>
                                <h4>Date: {{ $absence->day->format('d-m-Y') }}.</h4>
                            </div>
                            <thead>
                            <tr>
                                <th width="15%" class="text-center">Subject</th>
                                <th class="text-center">Content</th>
                            </tr>
                            </thead>
                            <tr>
                                <tbody>
                                <td class="text-center">Type</td>
                                <td class="text-center">@if ($absence->type == 1)
                                        Fulltime
                                    @elseif ($absence->type == 2)
                                        Parttime
                                    @else
                                        Other
                                    @endif
                                </td>
                                </tbody>
                            </tr>
                            <tr>
                                <tbody>
                                <td class="text-center">Start time</td>
                                <td class="text-center">@if($absence->type == 1)
                                        {{ $absence->start_time->format('d-m-Y') }}
                                    @else
                                        {{ $absence->start_time ->format('H:s d-m-Y') }}
                                    @endif
                                </td>
                                </tbody>
                            </tr>
                            <tr>
                                <tbody>
                                <td class="text-center">End time</td>
                                <td class="text-center">@if($absence->type == 1)
                                        {{ $absence->end_time->format('d-m-Y') }}
                                    @else
                                        {{ $absence->end_time ->format('H:s d-m-Y') }}
                                    @endif
                                </td>
                                </tbody>
                            </tr>
                            <tr>
                                <tbody>
                                 <td class="text-center">Content</td>
                                    <td class="text-center">{{ $absence->content }}</td>
                                </tbody>
                            </tr>
                        </table>
                        <a href="{{ route('absence.index') }}"><button type="button" class="btn btn-success" ><i></i>Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection