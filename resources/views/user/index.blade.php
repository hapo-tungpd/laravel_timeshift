@extends('user.layouts.master')

@section('content')
    <style>
        html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
    </style>
    <body class="w3-light-grey">
    <div class="box"></div>

    <!-- Page Container -->
    <div class="w3-content w3-margin-top" style="max-width:1400px;">

        <!-- The Grid -->
        <div class="w3-row-padding">

            <!-- Left Column -->
            <div class="w3-third">

                <div class="w3-white w3-text-grey w3-card-4">
                    <div class="w3-display-container">
                        <img src="{{ (Auth::user()->image == null) ? asset('img/default.png') : asset('storage/'.Auth::user()->image) }}" style="width:100%;" alt="Avatar">
                        <div class="w3-display-bottomleft w3-container w3-text-black">
                            <h2>{{ Auth::user()->name }}</h2>
                        </div>
                    </div>
                    <div class="w3-container" style="margin-top: 20px;">
                        <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Employee</p>
                        <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ Auth::user()->birthday->format('d-m-Y') }}</p>
                        <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ Auth::user()->address }}</p>
                        <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ Auth::user()->email }}</p>
                        <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ Auth::user()->phone }}</p>
                        <p><i class="fa fa-genderless fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ Auth::user()->gender?"Male":"Female" }}</p>
                        <p><i class="fa fa-book fa-fw w3-margin-right w3-large w3-text-teal"></i>{{ Auth::user()->JLPT }}</p>
                        <hr>
                        <form method="GET">
                            {{ csrf_field() }}
                            <a href="{{ route('user.edit', Auth::user()->id) }}" class="btn btn-primary btn-block"><b>Update profile</b></a>
                        </form>
                        <hr>
                    </div>
                </div><br>

                <!-- End Left Column -->
            </div>

            <!-- Right Column -->
            <div class="w3-twothird">

                <div class="w3-container w3-card w3-white w3-margin-bottom">
                    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Absence</h2>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('absence.create') }}"><i></i>Create Absence</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>{{ $absence->created_at }} - <span class="w3-tag w3-teal w3-round">Important</span></h6>
                        <p>Chức năng xin nghỉ cho phép bạn xin nghỉ cả ngày, nửa ngày và trong một khoảng thời gian trong ngày. Bạn cần xin nghỉ trước thời gian làm việc của ngày hôm sau.</p>
                        <hr>
                    </div>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('absence.create') }}"><i></i>Your absence</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>{{ Carbon\Carbon::now()->toFormattedDateString() }}</h6>
                        <p>Thống kê những lần xin nghỉ phép của bạn.</p>
                        <hr>
                    </div>
                </div>

                <div class="w3-container w3-card w3-white">
                    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Report</h2>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('report.create') }}"><i></i>Create report</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
                        <p>Trước khi rời khỏi văn phòng, bạn cần viết report cho một ngày làm việc.</p>
                        <hr>
                    </div>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('report.index') }}"><i></i>Your report</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015</h6>
                        <p>Thống kê toàn bộ report mà bạn đã viết.</p>
                        <hr>
                    </div>
                </div>
                <br>
                <div class="w3-container w3-card w3-white">
                    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Overtime</h2>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('overtime.create') }}"><i></i>Create your overtime</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
                        <p>Khi overtime, bạn cần tạo một báo cáo, bao gồm thời gian OT, report OT.</p>
                        <hr>
                    </div>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('overtime.index') }}"><i></i>Your overtime</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015</h6>
                        <p>Liệt kê những lần overtime của bạn.</p>
                        <hr>
                    </div>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('overtime.statistic') }}"><i></i>Statistic Overtime</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2010 - 2013</h6>
                        <p>Thống kê toàn bộ thông tin overtime của bạn theo tháng.</p><br>
                    </div>
                </div>
                <br>
                <div class="w3-container w3-card w3-white">
                    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Roll Call</h2>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('rollcall.create') }}"><i></i>Roll call now!</a>- <span class="w3-tag w3-teal w3-round">Important</span></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Forever</h6>
                        <p>Bạn cần điểm danh vào thời điểm bắt đầu đến công ty và trước khi rời khỏi công ty.</p>
                        <hr>
                    </div>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('rollcall.showAllRollCall') }}"><i></i>Your Roll Call</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2013 - 2015</h6>
                        <p>Liệt kê những lần điểm danh của bạn.</p>
                        <hr>
                    </div>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('rollcall.showAllRollCall') }}"><i></i>Statistic Roll Call</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>2010 - 2013</h6>
                        <p>Thống kê toàn bộ thông tin điểm danh của bạn theo tháng.</p><br>
                    </div>
                </div>

                <!-- End Right Column -->
            </div>

            <!-- End Grid -->
        </div>

        <!-- End Page Container -->
    </div>
    <footer class="w3-container w3-teal w3-center w3-margin-top">
        <p>Find me on social media.</p>
        <a href="https://www.facebook.com/haposoft/"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
        <p>Design by <a href="https://haposoft.com/vi" target="_blank">Haposoft</a> INC.</p>
    </footer>
    </body>
@endsection
