@extends('admin.layouts.master')

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
                    <div class="form-group">
                        <label for="">Date</label>
                        @if ($errors->has('report_date'))
                            <p class="input-warning">{{ $errors->first('report_date') }}</p>
                        @endif
                        <input type="text" class="form-control" id="" name="report_date" autocomplete="off" value="{{ $report->report_date->format('d/m/Y') }}">
                    </div>

                    <div class="form-group">
                        <label for="">Today</label>
                        @if ($errors->has('today'))
                            <p class="input-warning">{{ $errors->first('today') }}</p>
                        @endif
                        <input type="text" class="form-control" id="" value="{{ $report->today }}" name="today" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="">Tomorrow</label>
                        @if ($errors->has('today'))
                            <p class="input-warning">{{ $errors->first('tomorrow') }}</p>
                        @endif
                        <input type="text" class="form-control" id="" value="{{ $report->tomorrow }}" name="tomorrow" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="">Problem</label>
                        @if ($errors->has('problem'))
                            <p class="input-warning">{{ $errors->first('problem') }}</p>
                        @endif
                        <input type="text" class="form-control" id="" value="{{ $report->problem }}" name="problem" required autocomplete="off">
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
