<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>
            <li><a href="{{ route('user.index') }}"><i class="fa fa-user"></i> <span>Profile</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Report</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('report.create') }}"><i class="fa fa-edit"></i>Create Report</a></li>
                    <li><a href="{{ route('report.index') }}"><i class="fa fa-folder-open"></i>Your Report</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Overtime</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('overtime.create') }}"><i class="fa fa-users"></i>Create Overtime</a></li>
                    <li><a href="{{ route('overtime.index') }}"><i class="fa fa-user-plus"></i>Your Overtime</a></li>
                    <li><a href="{{ route('overtime.statistic') }}"><i class="fa fa-user-plus"></i>Statistic Overtime</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Roll call</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('rollcall.create') }}"><i class="fa fa-users"></i>Roll call now!</a></li>
                    <li><a href="{{ route('rollcall.index') }}"><i class="fa fa-users"></i>Your Roll Call</a></li>
                    <li><a href="{{ route('rollcall.statistic') }}"><i class="fa fa-users"></i>Statistic Roll Call</a></li>
                </ul>>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>