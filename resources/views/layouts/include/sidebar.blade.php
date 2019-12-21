<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
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
        <li class="treeview {{ Request::is('soil*') || Request::is('region*') ? 'menu-open' : '' }}">
            <a href="#"><i class="fa fa-link"></i> <span>Paketlerimiz</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu" style="{{ Request::is('soil*') || Request::is('region*') ? 'display: block' : '' }}">
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
            </ul>
          </li>
        <li class="treeview {{ Request::is('input*') ? 'menu-open' : '' }}">
          <a href="#"><i class="fa fa-link"></i> <span>Kitlerimiz</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu" style="{{ Request::is('input*') ? 'display: block' : '' }}">
            <li class="{{ Request::is('input*') ? 'active' : '' }}">
                <a href="{{ route('input.index') }}">
                    <span>Giriş İşlemleri</span>
                </a>
            </li>
            <li class="{{ Request::is('action*') ? 'active' : '' }}">
                <a href="{{ route('action.index') }}">
                    <span>Aksiyon İşlemleri</span>
                </a>
            </li>
            <li class="{{ Request::is('sensor*') ? 'active' : '' }}">
                <a href="{{ route('sensor.index') }}">
                    <span>Sensor İşlemleri</span>
                </a>
            </li>
            <li class="{{ Request::is('actuator*') ? 'active' : '' }}">
                <a href="{{ route('actuator.index') }}">
                    <span>Eyleyici İşlemleri</span>
                </a>
            </li>
            <li class="{{ Request::is('controller*') ? 'active' : '' }}">
                <a href="{{ route('controller.index') }}">
                    <span>Kontrolor İşlemleri</span>
                </a>
            </li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
