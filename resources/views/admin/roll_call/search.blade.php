@extends('admin.layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Roll Call
        </h1>
    </section>
    <section class="content">
        <div class="row justify-content-center">
            <div class="box">
            </div>
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-body">
                        @if(session('info'))
                            {{session('info')}}
                        @endif
                        <table class="table table-primary table-hover text-center table-show">
                            <thead>
                            <tr>
                                <th width="10%" class="text-center">No.</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Start time</th>
                                <th class="text-center">End time</th>
                                <th class="text-center">Total time</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody class="tbody-show">
                            @php
                                $temp = 1;
                            @endphp
                            @if(count($employees) > 0)
                                @foreach($employees as $data)
                                    <tr class="table-primary tr-show">
                                        <td class="text-center">{{ $temp++ }}</td>
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
                        <form action="{{ route('admin.rollcall.index') }}">
                            {{ csrf_field() }}
                            <button class="btn-sm btn btn-primary">BACK</button>
                        </form>
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
    </script>

@endsection