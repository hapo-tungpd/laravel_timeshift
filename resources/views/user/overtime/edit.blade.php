@extends('user.layouts.master')

@section('content')

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Update your Overtime</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('overtime.update', $overtime->id) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="box-body">
                    <div class="form-group">
                        @if ($errors->has('user_id'))
                            <p class="input-warning">{{ $errors->first('user_id') }}</p>
                        @endif
                        <input type="text" class="form-control hidden" name="user_id" autocomplete="off" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="form-group">
                        <label for="">Date</label>
                        @if ($errors->has('day'))
                            <p class="input-warning">{{ $errors->first('day') }}</p>
                        @endif
                        <input type="text" class="form-control over-time-picker" name="day" autocomplete="off" value="{{ $overtime->day->format('Y/m/d') }}">
                    </div>
                    <div class="form-group">
                        <label for="">Start time</label>
                        @if ($errors->has('start_time'))
                            <p class="input-warning">{{ $errors->first('start_time') }}</p>
                        @endif
                        <input type="time" class="form-control" value="{{ $overtime->start_time->format('H:i') }}" name="start_time" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">End time</label>
                        @if ($errors->has('end_time'))
                            <p class="input-warning">{{ $errors->first('end_time') }}</p>
                        @endif
                        <input type="text" class="form-control edit-over" value="{{ $overtime->end_time->format('H:i') }}" name="end_time" required autocomplete="off">
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ route('overtime.index') }}" class="btn btn-success">Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection