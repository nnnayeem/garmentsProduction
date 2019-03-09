<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{Auth::user() && Auth::user()->photo?Storage::url(Auth::user()->photo):'/image/a1.png'}}" class="img-rounded" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li {!! Request::is('admin')?'class="active"':'' !!}>
                <a href="/admin">
                    <i class="fa fa-th"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="header">Administrative</li>

            <li class="{{Request::is('admin/users*')?'active ':''}}treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>User</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li{!! Request::is('admin/users')?' class="active"':'' !!}><a href="/admin/users"><i class="fa fa-users"></i> Manage Users</a></li>
                    <li{!! Request::is('admin/users/create')?' class="active"':'' !!}><a href="/admin/users/create"><i class="fa  fa-user-plus"></i> Create Users</a></li>
                </ul>
            </li>



            <li class="{{Request::is('admin/permission*')?'active ':''}}treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Permissions</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li{!! Request::is('admin/permission')?' class="active"':'' !!}><a href="/admin/permission"><i class="fa fa-users"></i> Manage permissions</a></li>
                    <li{!! Request::is('admin/permission/create')?' class="active"':'' !!}><a href="/admin/permission/create"><i class="fa  fa-user-plus"></i> Create permissions</a></li>
                </ul>
            </li>

            <li class="header">Maintenance</li>
            <li class="{{Request::is('admin/buyers*')?'active ':''}}treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Buyers</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li{!! Request::is('admin/buyers')?' class="active"':'' !!}><a href="/admin/buyers"><i class="fa fa-users"></i> Manage Buyers</a></li>
                    <li{!! Request::is('admin/buyers/create')?' class="active"':'' !!}><a href="/admin/buyers/create"><i class="fa  fa-user-plus"></i> Create Buyers</a></li>
                </ul>
            </li>
            <li class="{{Request::is('admin/orders*')?'active ':''}}treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li{!! Request::is('admin/orders')?' class="active"':'' !!}><a href="/admin/orders"><i class="fa fa-users"></i> Manage Orders</a></li>
                    <li{!! Request::is('admin/orders/create')?' class="active"':'' !!}><a href="/admin/orders/create"><i class="fa  fa-user-plus"></i> Create Orders</a></li>
                </ul>
            </li>
            <li class="{{Request::is('admin/floors*')?'active ':''}}treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Floors</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li{!! Request::is('admin/m-controllers')?' class="active"':'' !!}><a href="/admin/floors"><i class="fa fa-users"></i> Manage Floors</a></li>
                    <li{!! Request::is('admin/m-controllers/create')?' class="active"':'' !!}><a href="/admin/floors/create"><i class="fa  fa-user-plus"></i>Add Floors</a></li>
                </ul>
            </li>
            <li class="{{Request::is('admin/floors*')?'active ':''}}treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Targets</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li{!! Request::is('admin/targets')?' class="active"':'' !!}><a href="/admin/floors"><i class="fa fa-users"></i> Manage Targets</a></li>
                    <li{!! Request::is('admin/targets/create')?' class="active"':'' !!}><a href="/admin/floors/create"><i class="fa  fa-user-plus"></i>Add Targets</a></li>
                </ul>
            </li>
            <li {!! Request::is('admin')?'class="active"':'' !!}>
                <a href="/admin/production">
                    <i class="fa fa-th"></i> <span>Production</span>
                </a>
            </li>

            <li class="header">Store</li>
            <li class="{{Request::is('admin/store*')?'active ':''}}treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Store</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li{!! Request::is('admin/m-controllers')?' class="active"':'' !!}><a href="/admin/store"><i class="fa fa-users"></i> Manage Store</a></li>
                    <li{!! Request::is('admin/m-controllers/create')?' class="active"':'' !!}><a href="/admin/store/create"><i class="fa  fa-user-plus"></i>Add Store</a></li>
                </ul>
            </li>

            <li class="{{Request::is('admin/machine-category*')?'active ':''}}treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Machine Category</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li{!! Request::is('admin/machine-category')?' class="active"':'' !!}><a href="/admin/machine-category"><i class="fa fa-users"></i> Manage Category</a></li>
                    <li{!! Request::is('admin/machine-category/create')?' class="active"':'' !!}><a href="/admin/machine-category/create"><i class="fa  fa-user-plus"></i>Add Category</a></li>
                </ul>
            </li>

            <li {!! Request::is('admin/parts')?'class="active"':'' !!}>
                <a href="/admin/parts">
                    <i class="fa fa-th"></i> <span>Parts</span>
                </a>
            </li>
            <li class="{{Request::is('admin/machines*')?'active ':''}}treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Machines</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li{!! Request::is('admin/m-controllers')?' class="active"':'' !!}><a href="/admin/machines"><i class="fa fa-users"></i> Manage Machines</a></li>
                    <li{!! Request::is('admin/m-controllers/create')?' class="active"':'' !!}><a href="/admin/machines/create"><i class="fa  fa-user-plus"></i>Add Machines</a></li>
                </ul>
            </li>
            <li {!! Request::is('admin/machine-history')?'class="active"':'' !!}>
                <a href="/admin/machine-history">
                    <i class="fa fa-th"></i> <span>Defected Machine</span>
                </a>
            </li>



            <li class="header">Request Platform</li>
            <li class="{{Request::is('admin/request-platform*')?'active ':''}}treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Request Platform</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li{!! Request::is('admin/request-platform')?' class="active"':'' !!}><a href="/admin/request-platform"><i class="fa fa-users"></i> Manage Requests</a></li>
                    <li{!! Request::is('admin/request-platform/create')?' class="active"':'' !!}><a href="/admin/request-platform/create"><i class="fa  fa-user-plus"></i>Manage Request</a></li>
                </ul>
            </li>
            <li class="{{Request::is('admin/general-store*')?'active ':''}}treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>general-store</span>
                    <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li{!! Request::is('admin/general-store')?' class="active"':'' !!}><a href="/admin/general-store"><i class="fa fa-users"></i> Manage general-store</a></li>
                    <li{!! Request::is('admin/general-store/create')?' class="active"':'' !!}><a href="/admin/general-store/create"><i class="fa  fa-user-plus"></i>Create general-store</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>