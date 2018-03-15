@extends('user.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="alert card-header alert-success">Welcome to Absence, {{ Auth::user()->name }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('absence.create', Auth::user()->id) }}" method="GET">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary ">
                                <i class="fa fa-th-list"></i>
                                Create new Absence
                            </button>
                        </form>
                            <br>
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Start time</th>
                                <th class="text-center">End time</th>
                                <th class="text-center">Content</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach($absence as $data)
                                <tbody>
                                <td class="text-center">{{ $temp++ }}</td>
                                <td class="text-center">{{ $data->day->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    @if ($data->type == 1)
                                        Full day
                                    @elseif ($data->type == 2)
                                        Half day
                                    @else
                                        Other
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ $data->start_time->format('H:s A') }}
                                </td>
                                <td class="text-center">
                                    {{ $data->end_time ->format('H:s A') }}
                                </td>
                                <td class="text-center">{{ str_limit($data->content, 20) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('absence.show', $data->id) }}">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-th-list"></i>
                                        </button>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('absence.edit', $data->id) }}">
                                        <button class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        var rate_value;
        if (document.getElementById('r1').checked) {
            rate_value = "Fsafsfsf";
        }
        document.getElementById('results').innerHTML = rate_value;
    </script>
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