<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">İşlemler Menüsü</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <i class="fa fa-dashboard"></i>
                <span>Kontrol Paneli</span>
            </a>
        </li>
        <li class="{{ Request::is('soil*') ? 'active' : '' }}">
            <a href="{{ route('soil.index') }}">
                <span>Toprak İşlemleri</span>
            </a>
        </li>
        <li class="{{ Request::is('region*') ? 'active' : '' }}">
            <a href="{{ route('region.index') }}">
                <span>İklim İşlemleri</span>
            </a>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>