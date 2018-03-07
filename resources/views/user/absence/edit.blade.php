@extends('user.layouts.master')

@section('content')

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Update your Absence</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('absence.update', $absence->id) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Your ID</label>
                        @if ($errors->has('user_id'))
                            <p class="input-warning">{{ $errors->first('user_id') }}</p>
                        @endif
                        <input type="text" class="form-control" name="user_id" autocomplete="off" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="form-group">
                        <label for="">Date</label>
                        @if ($errors->has('day'))
                            <p class="input-warning">{{ $errors->first('day') }}</p>
                        @endif
                        <input type="text" class="form-control absence-time-picker" name="day" autocomplete="off" value="{{ $absence->day->format('d/m/Y') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Start time</label>
                        @if ($errors->has('start_time'))
                            <p class="input-warning">{{ $errors->first('start_time') }}</p>
                        @endif
                        <input type="text" class="datetimepicker1 form-control" value="{{ $absence->start_time->format('Y-m-d H:s:i') }}" name="start_time" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">End time</label>
                        @if ($errors->has('end_time'))
                            <p class="input-warning">{{ $errors->first('end_time') }}</p>
                        @endif
                        <input type="text" class="datetimepicker1 form-control" value="{{ $absence->end_time->format('Y-m-d H:s:i') }}" name="end_time" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">Content</label>
                        @if ($errors->has('content'))
                            <p class="input-warning">{{ $errors->first('content') }}</p>
                        @endif
                        <input type="text" class="form-control" id="" value="{{ $absence->content }}" name="content" required autocomplete="off">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection
