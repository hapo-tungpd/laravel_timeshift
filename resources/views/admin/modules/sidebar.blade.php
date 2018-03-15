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
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>User</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-users"></i>User list</a></li>
                    <li><a href="{{ route('admin.user.create') }}"><i class="fa fa-user-plus"></i>Add new user</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.absence.index') }}">
                    <i class="fa fa-calendar-minus-o"></i> <span>Absence</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-clock-o"></i> <span>Overtime</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.overtime.index') }}"><i class="fa fa-clock-o"></i>Overtime</a></li>
                    <li><a href="{{ route('admin.overtime.statistic') }}"><i class="fa fa-book"></i>Statistic Overtime</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>