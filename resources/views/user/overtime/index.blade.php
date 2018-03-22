@extends('user.layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Overtime
        </h1>
    </section>
    <section class="content">
        <div class="box">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
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
                        <div class="row">
                            <form class="form-inline my-2 my-lg-0 table table-hover table-bordered" action="{{ route('overtime.index') }}" method="post">
                                {{csrf_field()}}
                                {{ method_field('GET') }}
                                <div class="col-md-3">
                                    <input type="text" name="from_date" id="from_date" class="form-control filter-overtime over-time-picker" placeholder="From Date" />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="to_date" id="to_date" class="form-control filter-overtime over-time-picker" placeholder="To Date" />
                                </div>
                                <div class="col-md-5">
                                    <input type="submit" name="filter" id="filter" value="Search" class="btn btn-info" />
                                </div>
                            </form>
                        </div>
                        <br>
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Start time</th>
                                <th class="text-center">End time</th>
                                <th class="text-center">Total time</th>
                                <th class="text-center">Show</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach($overtime as $data)
                                <tbody>
                                <td class="text-center">{{ $temp++ }}</td>
                                <td class="text-center">{{ $data->day->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $data->start_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $data->end_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $data->total_time }} hours</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $data->id }}">Detail</button>
                                    <div id="{{ $data->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h3 class="modal-title">Overtime detail</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <h4><strong>{{ $data->user->name }}</strong></h4>
                                                </div>
                                                <div class="">
                                                    <p>
                                                        Date: {{ $data->day->format('d/m/Y') }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Start time: {{ $data->start_time->format('H:i:s') }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        End time: {{ $data->end_time->format('H:i:s') }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        Total: {{ $data->total_time }}
                                                    </p>
                                                </div><div class="modal-body">
                                                    <p>
                                                        Report: {{ $data->content }}
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('overtime.edit', $data->id) }}">
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="#" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" data-id="{{ $data->id }}"
                                                class="fa fa-trash-o btn btn-danger btn-sm"></button>
                                    </form>
                                </td>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script>
        $(function () {
            // AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.btn-danger', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log(id);
                var btn = $(this);
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                    if(willDelete) {
                        $.ajax({
                            type: 'delete',
                            url: 'overtime/' + id,
                            success: function (response) {
                                btn.parent().parent().parent().fadeOut('slow');
                            },
                            error: function (xhr, status, error) {
                                toastr.error('Unable to delete.', 'Error!');
                            },
                        });
                    }
                }
            )
                ;
            });
            // END AJAX
        });
    </script>

@endsection
