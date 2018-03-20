@extends('user.layouts.master')

@section('content')
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
                            <a href="{{ route('edit', Auth::user()->id) }}" class="btn btn-primary btn-block"><b>Update profile</b></a>
                        </form>
                        <hr>
                    </div>
                </div><br>

                <!-- End Left Column -->
            </div>

            <!-- Right Column -->
            <div class="w3-twothird">

                <div class="w3-container w3-card w3-white w3-margin-bottom">
                    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-calendar-times-o fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Absence</h2>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('absence.create') }}"><i></i>Create Absence</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>{{ Carbon\Carbon::now()->toFormattedDateString() }} - <span class="w3-tag w3-teal w3-round">Important</span></h6>
                        <p>The absence function allows you to apply for a full day, half-day, and part-time absence. You need to take absence before the next working day.</p>
                        <hr>
                    </div>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('absence.create') }}"><i></i>Your absence</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Created {{ $absence->created_at->diffForHumans() }}</h6>
                        <p>Statistics of your time to take a vacation.</p>
                        <hr>
                    </div>
                </div>

                <div class="w3-container w3-card w3-white">
                    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-book fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Report</h2>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('report.create') }}"><i></i>Create report</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>{{ Carbon\Carbon::now()->toFormattedDateString() }}</h6>
                        <p>Before leaving the office, you need to write a report for a working day.</p>
                        <hr>
                    </div>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('report.index') }}"><i></i>Your report</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Created {{ $report->created_at->diffForHumans() }}</h6>
                        <p>Statistics the entire report that you wrote.</p>
                        <hr>
                    </div>
                </div>
                <br>
                <div class="w3-container w3-card w3-white">
                    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-clock-o fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Overtime</h2>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('overtime.create') }}"><i></i>Create your overtime</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>{{ Carbon\Carbon::now()->toFormattedDateString() }}</h6>
                        <p>When overtime, you need to create a report, including OT time, OT report.</p>
                        <hr>
                    </div>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('overtime.index') }}"><i></i>Your overtime</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Created {{ $overtime->created_at->diffForHumans() }}</h6>
                        <p>List your overtime.</p>
                        <hr>
                    </div>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('overtime.statistic') }}"><i></i>Statistic Overtime</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>{{ Carbon\Carbon::now()->format('m-Y') }}</h6>
                        <p>Statistics entire information of your monthly overtime.</p><br>
                    </div>
                </div>
                <br>
                <div class="w3-container w3-card w3-white">
                    <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-check-square-o fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Roll Call</h2>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('rollcall.create') }}"><i></i>Roll call now!</a> - <span class="w3-tag w3-teal w3-round">Important</span></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>{{ Carbon\Carbon::now()->toFormattedDateString() }}</h6>
                        <p>You need to roll call at the start of the company and before leaving the company.</p>
                        <hr>
                    </div>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('rollcall.showAllRollCall') }}"><i></i>Your Roll Call</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>Created {{ $rollcall->created_at->diffForHumans() }}</h6>
                        <p>List your roll call.</p>
                        <hr>
                    </div>
                    <div class="w3-container">
                        <h5 class="w3-opacity"><a href="{{ route('rollcall.showAllRollCall') }}"><i></i>Statistic Roll Call</a></h5>
                        <h6 class="w3-text-teal"><i class="fa fa-calendar fa-fw w3-margin-right"></i>{{ Carbon\Carbon::now()->format('m-Y') }}</h6>
                        <p>Statistical entire roll call your information by month.</p><br>
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
        <p>Design by <a href="https://haposoft.com/vi" target="_blank">Haposoft</a> Inc.</p>
    </footer>
    </body>
@endsection
