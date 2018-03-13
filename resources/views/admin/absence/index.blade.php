@extends('admin.layouts.master')

@section('content')

    <section class="content-header">
        <h1>
            Absence List
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover display" id="">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Content</th>
                            <th>Show</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($absences as $absence)
                            <tr>
                                <td>{{ $absence->user->name }}</td>
                                <td>{{ ($absence->day != null) ? $absence->day->format('d-m-Y') : "" }}</td>
                                <td>
                                    {{ ($absence->type == 1) ? 'Full day' : (($absence->type == 2) ? 'Half day' : 'Other') }}
                                </td>
                                <td>{{ ($absence->start_time != null) ? $absence->start_time->format('H:i') : "" }}</td>
                                <td>{{ ($absence->end_time != null) ? $absence->end_time->format('H:i') : "" }}</td>
                                <td>{{ $absence->content }}</td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#{{ $absence->id }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-th-list"></i>
                                    </button>
                                </td>
                                <td>
                                    <form action="" method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" data-id="{{ $absence->id }}" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div id="{{ $absence->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h3 class="modal-title">Absence detail</h3>
                                        </div>
                                        <div class="modal-body">
                                            <h4><strong>{{ $absence->user->name }}</strong></h4>
                                            <p>Date: {{ ($absence->day != null) ? $absence->day->format('d-m-Y') : "" }}</p>
                                            <p>
                                                Absent type: {{ ($absence->type == 1) ? 'Full day' :
                                                (($absence->type == 2) ? 'Half day' : 'Other') }}
                                            </p>
                                            <p>
                                                From {{ ($absence->start_time != null) ? $absence->start_time->format('H:i') : "" }}
                                                to {{ ($absence->end_time != null) ? $absence->end_time->format('H:i') : "" }}
                                            </p>
                                            <span><strong>Content: </strong></span>
                                            <p>{{ $absence->content }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $absences->links() }}

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
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
                            url: 'absence/' + id,
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
