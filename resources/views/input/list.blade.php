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
                  <div id="collapseActions" class="panel-collapse collapse" aria-expanded="false">
                    <div class="box-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                      eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                      assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                      nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                      farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                      labore sustainable VHS.
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
 
@endpush 