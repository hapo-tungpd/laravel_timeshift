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
                        <input type="date" class="form-control" name="day" autocomplete="off" value="{{ $overtime->day->format('d/m/Y') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Start time</label>
                        @if ($errors->has('start_time'))
                            <p class="input-warning">{{ $errors->first('start_time') }}</p>
                        @endif
                        <input type="time" class="form-control" value="{{ $overtime->start_time->format('H:s') }}" name="start_time" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="">End time</label>
                        @if ($errors->has('end_time'))
                            <p class="input-warning">{{ $errors->first('end_time') }}</p>
                        @endif
                        <input type="time" class="form-control" value="{{ $overtime->end_time->format('H:s') }}" name="end_time" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="">Total time</label>
                        @if ($errors->has('total_time'))
                            <p class="input-warning">{{ $errors->first('total_time') }}</p>
                        @endif
                        <input type="text" class="form-control" id="" value="{{ $overtime->total_time }}" name="total_time" required autocomplete="off">
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
