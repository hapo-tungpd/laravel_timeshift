@extends('user.layouts.master')

@section('content')
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> Create New Overtime</h3>
            </div>
            <form class="form-create" role="form" action="{{ route('overtime.store') }}" method="POST" enctype="multipart/form-data">
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
                        <input type="text" class="form-control over-time-picker" id="" name="day" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Start time</label>
                        @if ($errors->has('start_time'))
                            <p class="input-warning">{{ $errors->first('start_time') }}</p>
                        @endif
                        <input type="time" class="form-control" id="" name="start_time"
                               value="{{ \Carbon\Carbon::createFromFormat('H:i', '18:00')->format('H:i') }}">
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">End time</label>
                        @if ($errors->has('end_time'))
                            <p class="input-warning">{{ $errors->first('end_time') }}</p>
                        @endif
                        <input type="time" class="form-control" id="" name="end_time" value="{{ \Carbon\Carbon::createFromFormat('H:i', '23:00')->format('H:i') }}">
                    </div>
                </div>
                <div class="box-footer">
                    <a href="{{ route('overtime.index') }}" class="btn btn-success">Back</a>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection