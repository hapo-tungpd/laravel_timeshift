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
                        <label for="">User ID</label>
                        <input type="text" class="form-control" id="" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Date</label>
                        @if ($errors->has('day'))
                            <p class="input-warning">{{ $errors->first('day') }}</p>
                        @endif
                        <input type="date" class="form-control" id="" name="day">
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Type</label>
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="type" id="" value="1" checked >
                                Full time
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" id="" value="2" >
                                Part time
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="type" id="" value="3" >
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
                        <input data-format="y-m-d" type="text" class=" bfh-datepicker form-control datetimepicker1" name="start_time">
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="">End time</label>
                        @if ($errors->has('end_time'))
                            <p class="input-warning">{{ $errors->first('end_time') }}</p>
                        @endif
                        <input data-format="y-m-d" type="text" class=" bfh-datepicker form-control datetimepicker1" name="end_time">
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
