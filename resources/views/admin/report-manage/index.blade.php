@extends('admin.layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Report List
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                </div>
                    <div class="box-body table-responsive no-padding">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th width="3%" class="text-center">No.</th>
                                <th width="8%" class="text-center">Name</th>
                                <th width="8%" class="text-center">Date</th>
                                <th width="25%" class="text-center">Today</th>
                                <th width="25%" class="text-center">Tomorrow</th>
                                <th width="25%" class="text-center">Problem</th>
                                <th width="5%" class="text-center">Show</th>
                                <th width="5%" class="text-center">Delete</th>
                            </tr>
                            </thead>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach($report as $data)
                                <tbody>
                                <td class="text-center">{{ $temp++ }}</td>
                                <td class="text-center">{{ $data->user->name }}</td>
                                <td>{{ $data->day->format('d-m-Y') }}</td>
                                <td>{{ str_limit($data->today, 60) }}</td>
                                <td>{{ str_limit($data->tomorrow, 60) }}</td>
                                <td>{{ str_limit($data->problem, 60) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.report.show', $data->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-th-list"></i>
                                        </button>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="" method="post">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" data-id="{{ $data->id }}" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </td>
                                </tbody>
                            @endforeach
                        </table>
                        {{ $report->links() }}
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
                            url: 'report/' + id,
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
