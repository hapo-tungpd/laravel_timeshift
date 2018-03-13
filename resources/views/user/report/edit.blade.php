@extends('user.layouts.master')

@section('content')

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Update your report</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('report.update', $report->id) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="box-body">
                    <div class="form-group report-time-picker">
                        <label for="">Date</label>
                        @if ($errors->has('day'))
                            <p class="input-warning">{{ $errors->first('day') }}</p>
                        @endif
                        <input type="text" class="form-control report-time-picker" id="" name="day" autocomplete="off" value="{{ $report->day->format('Y-m-d') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Today</label>
                        @if ($errors->has('today'))
                            <p class="input-warning">{{ $errors->first('today') }}</p>
                        @endif
                        <textarea class="form-control" id="" name="today" required autocomplete="off">{{ $report->today }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Tomorrow</label>
                        @if ($errors->has('today'))
                            <p class="input-warning">{{ $errors->first('tomorrow') }}</p>
                        @endif
                        <textarea class="form-control" id="" name="tomorrow" required autocomplete="off">{{ $report->tomorrow }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Problem</label>
                        @if ($errors->has('problem'))
                            <p class="input-warning">{{ $errors->first('problem') }}</p>
                        @endif
                        <textarea class="form-control" id="" name="problem" required autocomplete="off">{{ $report->problem }}</textarea>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <a href="{{ route('report.index') }}"><button type="button" class="btn btn-success" ><i></i>Back</button></a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>

@endsection
