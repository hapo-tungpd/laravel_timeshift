@extends('admin.layouts.master')

@section('content')

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add new employee</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('admin.user.update', $user->id) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        @if ($errors->has('name'))
                            <p class="input-warning">{{ $errors->first('name') }}</p>
                        @endif
                        <input type="text" class="form-control" id="" name="name" autocomplete="off" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="optionsRadios1" value="1" {{ ($user->gender)?'checked':'' }} required>
                                Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" id="optionsRadios2" value="0" {{ (!$user->gender)?'checked':'' }} required>
                                Female
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Phone number</label>
                        @if ($errors->has('phone'))
                            <p class="input-warning">{{ $errors->first('phone') }}</p>
                        @endif
                        <input type="text" class="form-control" id="" value="{{ $user->phone }}" name="phone" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">Email address</label>
                        @if ($errors->has('email'))
                            <p class="input-warning">{{ $errors->first('email') }}</p>
                        @endif
                        <input type="email" class="form-control" id="" value="{{ $user->email }}" name="email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        @if ($errors->has('address'))
                            <p class="input-warning">{{ $errors->first('address') }}</p>
                        @endif
                        <input type="text" class="form-control" id="" value="{{ $user->address }}" name="address" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label>JLPT level</label>
                        <select class="form-control" name="JLPT">
                            <option value="N1" {{ ($user->JLPT == 'N1')?'selected':'' }}>N1</option>
                            <option value="N2" {{ ($user->JLPT == 'N2')?'selected':'' }}>N2</option>
                            <option value="N3" {{ ($user->JLPT == 'N3')?'selected':'' }}>N3</option>
                            <option value="N4" {{ ($user->JLPT == 'N4')?'selected':'' }}>N4</option>
                            <option value="N5" {{ ($user->JLPT == 'N5')?'selected':'' }}>N5</option>
                            <option value="None" {{ ($user->JLPT == 'None')?'selected':'' }}>None</option>
                        </select>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <a href="{{ route('admin.user.show', ['id'=>$user->id]) }}">
            <button class="btn btn-success">Profile</button>
        </a>
    </section>

@endsection
