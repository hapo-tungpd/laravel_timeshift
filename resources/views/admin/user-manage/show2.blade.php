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
                        <li><a href="#settings" data-toggle="tab">Settings</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">

                            <!-- Post -->
                            <p>TAB</p>

                            <!-- /.post -->

                            <!-- Post -->

                            <!-- /.post -->

                            <!-- Post -->

                            <!-- /.post -->
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="timeline">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                @foreach($user->reports as $report)
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

                        <div class="tab-pane" id="settings">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputExperience"
                                                  placeholder="Experience"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> I agree to the <a href="#">terms and
                                                    conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
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
