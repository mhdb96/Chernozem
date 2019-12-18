<section class="content-header">
    <h1>
      @yield('content-title')
      <small>@yield('content-description')</small>
    </h1>
    <ol class="breadcrumb">
        <li>
          <a href="{{ route('dashboard') }}">
              <i class="fa fa-dashboard"></i> Kontrol Paneli
            </a>
        </li>
        <li class="active">@yield('breadcrumb-title')</li>
    </ol>
</section>