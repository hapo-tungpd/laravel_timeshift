@extends('admin.layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            Administrator
        </h1>
    </section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover display" id="">
                    <tbody>
                    @foreach ($admin as $data)
                        <tr>
                            <td>
                                <a href="{{ route('admin.changepassword.edit', $data->id) }}">
                                    <button class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit">Change Password</i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong>Admin, Inc.</strong><br>
                                TẦNG 6 TÒA NHÀ THỐNG NHẤT<br>
                                SỐ 23 ĐƯỜNG TÔ VĨNH DIỆN, THANH XUÂN, HÀ NỘI<br>
                                Phone: +84-125-645-9898<br>
                                Email: {{ $data->email }}
                            </address>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </form>
        </div>
        <!-- /.box -->
    </div>
</section>

@endsection