@extends('admin.layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle"
                             src="{{ ($user->image == null) ? asset('img/default.png') : asset('storage/'.$user->image) }}"
                             alt="User profile picture">
                        {{--Trigger upload img modal--}}
                        <button type="button" class="btn btn-success btn-block" data-toggle="modal"
                                data-target="#myModal"><i class="fa fa-fw fa-upload"></i>Upload image
                        </button>
                        <br>
                        {{--End trigger--}}
                        <h3 class="profile-username text-center">{{ $user->name }}</h3>

                        <p class="text-muted text-center">Haposoft</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Birthday</b> <a
                                        class="pull-right">{{ ($user->birthday != null) ? $user->birthday->format('d-m-Y') : "" }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Gender</b> <a class="pull-right">{{ ($user->gender)?"Male":"Female" }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone number</b> <a class="pull-right">{{ $user->phone }}</a>
                            </li>
                        </ul>

                        <a href="{{ route('admin.user.edit', ['id'=>$user->id]) }}"
                           class="btn btn-primary btn-block"><b>Edit</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-home margin-r-5"></i> Address</strong>

                        <p class="text-muted">
                            {{ $user->address }}
                        </p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Certificate</strong>

                        <p>
                            <span class="label label-success">{{ $user->JLPT }}</span>
                        </p>

                        <hr>
                    </div>
                    <!-- /.box-body -->
                </div>

                {{--Modal--}}
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Upload profile image</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" action="{{ route('admin.user.update.image', ['id' => $user->id]) }}"
                                      method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <img class="hidden" id="uploadImg" src="#" alt="your image"/>
                                        <input class="hidden" type="file" id="imgFile" name="img">
                                        <button type="button" id="uploadImgBtn" class="btn btn-success"><i
                                                    class="fa fa-fw fa-upload"></i>Upload
                                        </button>
                                        <p class="help-block">Upload profile picture</p>
                                        <button type="submit" class="hidden" id="updateImg"></button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            {{--End modal--}}
            <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Roll call</a></li>
                        <li><a href="#timeline" data-toggle="tab">Report</a></li>
                        <li><a href="#absence" data-toggle="tab">Absence</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">

                            <!-- Roll Call Table -->
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Start time</th>
                                    <th class="text-center">End time</th>
                                    <th class="text-center">Total time</th>
                                </tr>
                                </thead>
                                @php
                                    $rollCalls = $user->rollCalls()->orderBy('updated_at', 'desc')
                                ->take(config('app.user_pagination'))->get();
                                @endphp
                                @foreach($rollCalls as $data)
                                    <tbody>
                                    <td class="text-center">{{ $data->day->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ $data->start_time->format('H:i:s') }}</td>
                                    <td class="text-center">{{ $data->end_time->format('H:i:s') }}</td>
                                    <td class="text-center">{{ $data->total_time }} hours</td>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                            @php
                                $reports = $user->reports()->orderBy('updated_at', 'desc')
                            ->take(config('app.report_limit'))->get();
                            @endphp
                                @foreach($reports as $report)
                                    <!-- timeline time label -->
                                    <li class="time-label">
                                        <span class="bg-red">
                                          {{ $report->day->format('d-m-Y') }}
                                        </span>
                                    </li>
                                <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <li>
                                        <i class="fa fa-envelope bg-blue"></i>

                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                                <a href="#">Updated at: </a>
                                                <i class="fa fa-clock-o"></i> {{ $report->updated_at->format('H:i') }}
                                            </h3>
                                            <strong>Today</strong>
                                            <div class="timeline-body">
                                                {!! $report->today !!}
                                            </div>
                                            <strong>Tomorrow</strong>
                                            <div class="timeline-body">
                                                {!! $report->tomorrow !!}
                                            </div>
                                            <strong>Problem</strong>
                                            <div class="timeline-body">
                                                {!! $report->problem !!}
                                            </div>
                                        </div>
                                    </li>
                                <!-- END timeline item -->
                                @endforeach
                                <!-- timeline time label -->
                                <li class="time-label">
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="absence">
                            <table class="table table-hover display" id="">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Content</th>
                                    <th>Show</th>
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
                                </tr>
                                </tfoot>
                                <tbody>
                                @php
                                    $absences = $user->absences()->orderBy('updated_at', 'desc')
                                ->take(config('app.user_pagination'))->get();
                                @endphp
                                @foreach ($absences as $absence)
                                    <tr>
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
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection()

@section('javascript')
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#uploadImg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function () {
            $("#imgFile").change(function () {
                $('#uploadImg').removeClass('hidden');
                readURL(this);
            });
            $('#uploadImgBtn').on('click', function () {
                $("#imgFile").trigger('click');
            });
            $('.modal-footer .btn-primary').on('click', function () {
                $("#updateImg").trigger('click');
            });
        });
    </script>
@endsection
