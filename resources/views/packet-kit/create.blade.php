@extends('layouts.master')

@section('title', 'Pakete göre Kit')

@section('content-title', 'Pakete göre Kit')
@section('content-description', 'Yeni Pakete göre Kit Ekle')
@section('breadcrumb-title', 'Pakete göre Kit')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">Yeni Pakete göre Kit Ekle</h3>
        </div>

        <form class="form-horizontal" action="{{ route('packet-kit.store') }}" method="POST">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="packet_id" class="col-sm-2 control-label">Paketler</label>
                    <div class="col-sm-8">
                        <select class="form-control select2" name="packet_id" data-placeholder="Paket Türünü Seçin" style="width: 100%;">
                            @foreach ($packets as $packet)                                
                                <option value="{{ $packet->id }}">{{ $packet->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  

                <div class="form-group">
                    <label for="kits" class="col-sm-2 control-label">Kitler</label>
                    <div class="col-sm-8">
                        <select class="form-control select2" multiple name="kits[]" data-placeholder="Kitleri Seçin" style="width: 100%;">
                            @foreach ($kits as $kit)                                
                                <option value="{{ $kit->id }}">{{ $kit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="listing-selected-kits">

                </div>

            </div>

            <div class="box-footer">
                <a href="{{ route('packet-kit.index') }}" class="btn btn-default">Geri</a>
                <button type="submit" class="btn btn-primary pull-right">Ekle</button>
            </div>

        </form>

      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() { 
        $('.select2').select2();

        $('[name ="kits[]"]').on("select2:select", function(e) {  

            $("#listing-selected-kits").append(`
                <div class="form-group" id="kit_${e.params.data.id}">
                    <label for="counts" class="col-sm-2 control-label">${e.params.data.text} - Sayısı</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="counts[${e.params.data.id}]" id="counts" placeholder="Kit Sayısı">
                    </div>
                </div>  
            `);
        });

        $('[name ="kits[]"]').on("select2:unselect", function(e) {  
            $(`#kit_${e.params.data.id}`)[0].remove();            
        });
    });
</script>
@endpush 