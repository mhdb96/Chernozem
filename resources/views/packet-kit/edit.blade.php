@extends('layouts.master')

@section('title', $packet->name.' Kit Ekleme Formu')

@section('content-title', $packet->name)
@section('content-description', 'Kit Ekleme Formu')
@section('breadcrumb-title', 'Pakete Kit Ekle')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">{{ $packet->name }} Kit Ekleme Formu</h3>
        </div>

        <form class="form-horizontal" action="{{ route('packet-kit.update', $packet->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group">
                    <label for="kits" class="col-sm-2 control-label">Kitler</label>
                    <div class="col-sm-8">
                        <select class="form-control select2" multiple name="kits[]" data-placeholder="Kitleri Seçin" style="width: 100%;">
                            @foreach ($kits as $kit)                                
                                <option value="{{ $kit->id }}" {{ in_array($kit->id, $selectedKitIds) ? 'selected' : '' }}>{{ $kit->name }}</option>
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
        selectedOptions = $('[name ="kits[]"]')[0].selectedOptions;

        if (selectedOptions.length > 0) {
          @foreach($selectedKits as $key => $kit)
            $("#listing-selected-kits").append(`
                <div class="form-group" id="kit_{{ $kit->kit_id }}">
                    <label for="counts" class="col-sm-2 control-label">${selectedOptions[ {{ $key }} ].text} - Sayısı</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="counts[{{ $kit->kit_id }}]" placeholder="Kit Sayısı" value="{{ $kit->count }}">
                    </div>
                </div>  
            `);
          @endforeach          
        }

        $('[name ="kits[]"]').on("select2:select", function(e) {  
            $("#listing-selected-kits").append(`
                <div class="form-group" id="kit_${e.params.data.id}">
                    <label for="counts" class="col-sm-2 control-label">${e.params.data.text} - Sayısı</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="counts[${e.params.data.id}]" placeholder="Kit Sayısı">
                    </div>
                </div>  
            `);

            $.ajax({
                type:'GET',
                url:'/get-packet-kit-count',
                data:{
                    packet_id: {{ $packet->id }},
                    kit_id: e.params.data.id,
                },
                success:function(data){   
                    if(data.count !== undefined)
                        $(`#kit_${e.params.data.id}`)[0].children[1].children[0].value = data.count;
                }
            }); 
        });

        $('[name ="kits[]"]').on("select2:unselect", function(e) {  
            $(`#kit_${e.params.data.id}`)[0].remove();            
        });
    });
</script>
@endpush 