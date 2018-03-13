@extends('user.layouts.master')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">Welcome to Overtime, {{ Auth::user()->name }}</div>
                    <legend class="text-center">Overtime</legend>
                    @if(session('info'))
                        {{session('info')}}
                    @endif
                    <table class="table table-primary table-hover text-center table-show">
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
                                        <a href="{{ route('admin.overtime.show', $data->id) }}">
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
                            <th>{{ $sum_time }} hour</th>
                        </tr>
                        </tbody>
                    </table>
                    <form action="{{ route('admin.overtime.index') }}">
                        {{ csrf_field() }}
                        <button class="btn btn-primary">BACK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
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