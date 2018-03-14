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
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-inline my-2 my-lg-0 table table-hover table-bordered" action="{{ route('admin.rollcall.search') }}" method="post">
                            {{csrf_field()}}
                            {{ method_field('GET') }}
                            <div class="col-md-3 over-time-picker">
                                <input type="text" name="from_date" id="from_date" class="form-control filter-overtime over-time-picker" placeholder="From Date" />
                            </div>
                            <div class="col-md-3 over-time-picker">
                                <input type="text" name="to_date" id="to_date" class="form-control filter-overtime over-time-picker" placeholder="To Date" />
                            </div>
                            <div class="col-md-5">
                                <input type="submit" name="filter" id="filter" value="Search" class="btn btn-info" />
                            </div>
                        </form>
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Name</th>
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
                            @foreach($rollCall as $data)
                                <tbody>
                                <td class="text-center">{{ $temp++ }}</td>
                                <td class="text-center">{{ $data->user->name }}</td>
                                <td class="text-center">{{ $data->day->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $data->start_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $data->end_time->format('H:i:s') }}</td>
                                <td class="text-center">{{ $data->total_time }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.rollcall.show', $data->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-th-list"></i>
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
                            url: 'rollcall/' + id,
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