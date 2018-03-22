@extends('admin.layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Roll Call
        </h1>
    </section>

    <section class="content">
        <div class="box">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="box box-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <form role="form" action="{{ route('admin.roll_call.index') }}" method="GET" class="form-inline">
                                <input type="hidden" name="_method" value="PUT">
                                {{ csrf_field() }}
                                <div class="input-group date datepicker fn" data-provide="datepicker">
                                    <input type="text" class="form-control" name="rollcall" data-date-format="Y-m-d" value="{{ $dateTimeMonth }}">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="submit">Detail</button>
                            </form>
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Roll Call</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Show</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach($rollCall as $data)
                                <tbody>
                                <td class="text-center">{{ $temp++ }}</td>
                                <td class="text-center">{{ $data->user->name }}</td>
                                <td class="text-center">{{ $data->day->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    @if($data->start_time != null)
                                        <a class="fa fa-check-square-o fa-fw w3-margin-right w3-xxlarge w3-text-teal"></a>
                                    @else
                                        <a class="fa fa-close fa-fw w3-margin-right w3-xxlarge w3-text-teal"></a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($data->total_time >= 8)
                                        <a class="fa fa-check-square-o fa-fw w3-margin-right w3-xxlarge w3-text-teal"></a>
                                    @else
                                        <a class="fa fa-close fa-fw w3-margin-right w3-xxlarge w3-text-teal"></a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#{{ $data->id }}">Detail</button>
                                    <div id="{{ $data->id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h3 class="modal-title">Roll Call detail</h3>
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
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                        {{ $rollCall->links() }}
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
                            url: 'roll_call/' + id,
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

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
        });
    </script>

@endsection
