@extends('layouts.master')

@section('title', $kit->name.' Verileri ve İşlemleri')

@section('content-title', $kit->name)
@section('content-description', 'Verileri ve İşlemleri')
@section('breadcrumb-title', $kit->name)

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseInputs" aria-expanded="false" class="collapsed">
                            {{ $kit->name }} Verileri
                        </a>
                    </h4>
                  </div>
                  <div id="collapseInputs" class="panel-collapse collapse in">
                    <div class="box-body">
                        @foreach ($inputs as $item)
                            <div class="col-sm-4 col-xs-12">
                                <div class="small-box bg-green">
                                    <div class="inner inner-sensor">
                                        <h4>{{ $item->name }} Verileri</h4>
                                    </div>
                                    <a href="{{ route('input.show', $item->id) }}" class="small-box-footer">
                                        İncele <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                  </div>
                </div>
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseActions" class="collapsed" aria-expanded="false">
                            {{ $kit->name }} İşlemleri
                        </a>
                    </h4>
                  </div>
                  <div id="collapseActions" class="panel-collapse collapse in" aria-expanded="false">
                    <div class="box-body">
                        @foreach ($actions as $action)                          
                          <div class="action">
                            <span class="action-name">
                              {{ $action->name }}
                            </span>
                            <label class="switch">
                              <input type="checkbox" class="setters" value="{{ $action->firebase_code }}">
                              <span class="slider round"></span>
                            </label>
                          </div>
                        @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
</section>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase.js"></script>
<script src="{{ asset('js/firebase.js') }}"></script>

<script>
    $(document).ready(function() {           
        var setters = document.getElementsByClassName("setters");    

        getSetters('{{ $mac_adress }}', setters);

        for (var i = 0; i < setters.length; i++) {
          setters[i].addEventListener('click', function() {            
            updateSetters('{{ $mac_adress }}', this);
          });
        }
    });
</script>
@endpush 