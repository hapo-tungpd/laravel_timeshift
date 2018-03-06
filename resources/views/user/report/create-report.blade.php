@extends('user.layouts.master')

@section('content')
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> Create New Report</h3>
            </div>

            <form class="form-create" role="form" action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
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
                        <label for="">Today</label>
                        @if ($errors->has('today'))
                            <p class="input-warning">{{ $errors->first('today') }}</p>
                        @endif
                        {{--<input type="text" class="form-control" id="" name="today">--}}
                        <textarea rows="4" cols="50" name="today" class="form-control"></textarea>
                    </div>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label for="">Tomorrow</label>
                        @if ($errors->has('tomorrow'))
                            <p class="input-warning">{{ $errors->first('tomorrow') }}</p>
                        @endif
                        <textarea rows="4" cols="50" name="tomorrow" class="form-control"></textarea>
                        {{--<input type="text" class="form-control" id="" name="tomorrow">--}}
                    </div>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label for="">Problem</label>
                        @if ($errors->has('problem'))
                            <p class="input-warning">{{ $errors->first('problem') }}</p>
                        @endif
                        {{--<input type="text" class="form-control" id="" name="problem">--}}
                        <textarea rows="4" cols="50" name="problem" class="form-control"></textarea>
                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{ route('report.index') }}" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection