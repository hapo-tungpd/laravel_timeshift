@extends('user.layouts.master')

@section('content')
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> Create New Absence</h3>
            </div>
            <form class="form-create" role="form" action="{{ route('absence.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <input type="text" class="form-control hidden" id="" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Date</label>
                        @if ($errors->has('day'))
                            <p class="input-warning">{{ $errors->first('day') }}</p>
                        @endif
                        <div class="input-group date" data-provide="datepicker" data-date-format="dd/mm/yyyy">
                            <input type="text" class="form-control" name="day" >
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Type</label>
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="type" id="fullday" value="1" checked >
                                Full day
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" id="halfday" value="2" >
                                Half day
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" id="other" value="3" >
                                Other
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Start time</label>
                        @if ($errors->has('start_time'))
                            <p class="input-warning">{{ $errors->first('start_time') }}</p>
                        @endif
                        <div class="input-group bootstrap-timepicker timepicker">
                            <input id="timepicker1" type="text" class="form-control input-small" name="start_time" value="08:30 AM">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">End time</label>
                        @if ($errors->has('end_time'))
                            <p class="input-warning">{{ $errors->first('end_time') }}</p>
                        @endif
                        <div class="input-group bootstrap-timepicker timepicker">
                            <input id="timepicker2" type="text" class="form-control input-small" name="end_time" value="06:00 PM">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Content</label>
                        @if ($errors->has('content'))
                            <p class="input-warning">{{ $errors->first('content') }}</p>
                        @endif
                        {{--<input type="text" class="form-control" id="" name="content">--}}
                        <textarea name="content" class="form-control"></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('absence.index') }}" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('javascript')
    <script type="text/javascript">
        $('#timepicker1').timepicker();
        $('#timepicker2').timepicker();
    </script>
    <script>
        $(function() {
            $("#fullday").on('click', function() {
                $('#timepicker1').val('08:30 AM');
                $('#timepicker2').val('06:00 PM');
            });
            $("#halfday").on('click', function() {
                $('#timepicker1').val('08:30 AM');
                $('#timepicker2').val('12:00 PM');
            });
        })
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
        });
    </script>
@endsection
