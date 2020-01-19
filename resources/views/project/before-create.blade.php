@extends('layouts.master')

@section('title', 'Paket Seçme Formu')

@section('content-title', 'Paket Seçme Formu')
@section('breadcrumb-title', 'Paket Seçme Formu')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">Paket Seçme Formu</h3>
        </div>

        <form class="form-horizontal" action="{{ route('project.create') }}" method="GET">
            <div class="box-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">İklim Türleri</label>
                    <div class="col-sm-8">
                        <select class="form-control select2" style="width: 100%;" name="regions" data-placeholder="İklim Türünü Seçin">
                            <option></option>
                            @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Toprak Türleri</label>
                    <div class="col-sm-8">
                        <select class="form-control select2" style="width: 100%;" name="region_soil" data-placeholder="Toprak Türünü Seçin">
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Bitki Türleri</label>
                    <div class="col-sm-8">
                        <select class="form-control select2" style="width: 100%;" name="soil_plant" data-placeholder="Bitki Türünü Seçin">
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Saha Türleri</label>
                    <div class="col-sm-8">
                        <select class="form-control select2" style="width: 100%;" name="areas" data-placeholder="Saha Türünü Seçin">
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Paket Türleri</label>
                    <div class="col-sm-8">
                        <select class="form-control select2" style="width: 100%;" name="packet_id" data-placeholder="Paket Türünü Seçin">
                            <option></option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">İleri</button>
            </div>

        </form>

      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
    $('.select2').select2();   
    
    function filterBy(selectedElement, url, targetElement) {    
        var id = $(`[name ="${selectedElement}"]`)[0].value; 
        $.ajax({
            type:'GET',
            url: `/${url}`,
            data:{
                id: id
            },
            success:function(data){  
                $(`[name ="${targetElement}"]`).html('<option></option>').select2();             
                $(`[name ="${targetElement}"]`).select2({
                    data: data                
                }); 
            }
        });     
    };

    $('[name ="regions"]').change(function() {
        filterBy('regions', 'region-soils', 'region_soil');
    });

    $('[name ="soil_plant"]').change(function() {
        filterBy('soil_plant', 'areas', 'areas');
    });

    $('[name ="region_soil"]').change(function() {
        filterBy('region_soil', 'soil-plants', 'soil_plant');
    });

    $('[name ="areas"]').change(function() {
        filterBy('areas', 'packets', 'packet_id');
    });
</script>
@endpush 