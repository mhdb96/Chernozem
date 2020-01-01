<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            @if(Auth::user()->role->name == 'admin')
                <p>{{ Auth::user()->admin->first_name }} {{ Auth::user()->admin->last_name }}</p>
            @else
                <p>{{ Auth::user()->customer->first_name }} {{ Auth::user()->customer->last_name }}</p>
            @endif
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
        
        @if(Auth::user()->role->name == 'admin')
        <li class="treeview {{ Request::is('soil*') || Request::is('region*') || Request::is('packet*') || Request::is('plant*') || Request::is('area*') ||  Request::is('area-capacity*') ? 'menu-open' : '' }}">
            <a href="#"><i class="fa fa-link"></i> <span>Paketlerimiz</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul 
                class="treeview-menu" 
                style="{{ Request::is('soil*') || Request::is('region*') || Request::is('packet*') || Request::is('plant*') || Request::is('area') || Request::is('area/*') ||  Request::is('area-capacity*') ? 'display: block' : '' }}">
                <li class="{{ Request::is('packet*') && !Request::is('packet-*') ? 'active' : '' }}">
                    <a href="{{ route('packet.index') }}">
                        <span>Paket İşlemleri</span>
                    </a>
                </li>
                <li class="{{ Request::is('packet-kit*') ? 'active' : '' }}">
                    <a href="{{ route('packet-kit.index') }}">
                        <span>Paketlere Kit Ekle</span>
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
                <li class="{{ Request::is('plant*') ? 'active' : '' }}">
                    <a href="{{ route('plant.index') }}">
                        <span>Bitki İşlemleri</span>
                    </a>
                </li>
                <li class="{{ Request::is('area*') && !Request::is('area-*') ? 'active' : '' }}">
                    <a href="{{ route('area.index') }}">
                        <span>Saha İşlemleri</span>
                    </a>
                </li>
                <li class="{{ Request::is('area-capacity*') ? 'active' : '' }}">
                    <a href="{{ route('area-capacity.index') }}">
                        <span>Saha Kapasite İşlemleri</span>
                    </a>
                </li>
            </ul>
          </li>
        <li class="treeview {{ Request::is('kit*') || Request::is('input*') || Request::is('action*') || Request::is('sensor*') || Request::is('actuator*') || Request::is('controller*') ? 'menu-open' : '' }}">
          <a href="#"><i class="fa fa-link"></i> <span>Kitlerimiz</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu" style="{{ Request::is('kit*') || Request::is('input*') || Request::is('action*') || Request::is('sensor*') || Request::is('actuator*') || Request::is('controller*') ? 'display: block' : '' }}">
            <li class="{{ Request::is('kit*') ? 'active' : '' }}">
                <a href="{{ route('kit.index') }}">
                    <span>Kit İşlemleri</span>
                </a>
            </li>
            <li class="{{ Request::is('input*') ? 'active' : '' }}">
                <a href="{{ route('input.index') }}">
                    <span>Giriş İşlemleri</span>
                </a>
            </li>
            <li class="{{ Request::is('action*') ? 'active' : '' }}">
                <a href="{{ route('action.index') }}">
                    <span>Eylem İşlemleri</span>
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
        <li class="treeview {{ Request::is('category*') || Request::is('type*') || Request::is('unit*') ? 'menu-open' : '' }}">
            <a href="#"><i class="fa fa-link"></i> <span>Diger</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu" style="{{ Request::is('category*') || Request::is('type*') || Request::is('unit*') ? 'display: block' : '' }}">
                <li class="{{ Request::is('category*') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}">
                        <span>Kategori İşlemleri</span>
                    </a>
                </li>
                <li class="{{ Request::is('type*') ? 'active' : '' }}">
                    <a href="{{ route('type.index') }}">
                        <span>Tip İşlemleri</span>
                    </a>
                </li>
                <li class="{{ Request::is('unit*') ? 'active' : '' }}">
                    <a href="{{ route('unit.index') }}">
                        <span>Birim İşlemleri</span>
                    </a>
                </li>
                <li class="{{ Request::is('mac-address*') ? 'active' : '' }}">
                    <a href="{{ route('mac-address.index') }}">
                        <span>Mac İşlemleri</span>
                    </a>
                </li>
            </ul>
        </li>

        @endif

        @if(Auth::user()->role->name == 'customer')
        <li class="treeview">
            <a href="#">
              <i class="fa fa-edit"></i> <span>Proje İşlemleri</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <li><a href="{{ route('project.create') }}">Proje Oluştur</a></li>

                @foreach (\App\Models\Project::all() as $project)
                    <li><a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a></li>
                @endforeach

            </ul>
        </li>
        @endif

        <li class="treeview"> 
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i> Çıkış Yap
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
                @csrf
            </form>
        </li>

      
      
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
