@extends('layouts.master')

@section('title', $packet->name.' Proje Oluşturma Formu')

@section('content-title',  $packet->name)
@section('content-description', 'Proje Oluşturma Formu')
@section('breadcrumb-title', 'Proje Oluşturma Formu')

@push('styles')
    <style>
        .icheckbox_square-blue:last-child { margin-left: 20px; }
    </style>
@endpush

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">{{ $packet->name }} Proje Oluşturma Formu</h3>
        </div>

        <form class="form-horizontal" action="{{ route('project.store') }}" method="POST">
            <input type="hidden" name="packet_id" value="{{ $packet_id }}">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">İsim</label>  
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="name" name="name" placeholder="İsim" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Başlangıç Tarihi:</label>
                    <div class="col-sm-8">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right date" id="start_date" name="start_date" placeholder="Projenin Başlangıç Tarihini Seçin" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Bitiş Tarihi:</label>
                    <div class="col-sm-8">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right date" id="end_date" name="end_date" placeholder="Projenin Bitiş Tarihini Seçin" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Arazi Var mı?</label>
                    <div class="col-sm-8">
                        <input type="radio" name="owns_area" class="minimal" value="1" required> Var 
                        <input type="radio" name="owns_area" class="minimal" value="0" required> Yok
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Proje Maliyeti</label>  
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="budget" id="budget" value="{{ $budget }}" readonly required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Saha Sayısı</label>  
                    <div class="col-sm-8">
                      <input type="number" class="form-control" id="area_count" name="area_count" placeholder="Saha Sayısı" required>
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-success" id="add-area-inputs">Ekle</button>
                    </div>
                </div>

                <hr>
                
                <div id="listing-area"></div>

            </div>

            <div class="box-footer">
                <a href="{{ route('project.index') }}" class="btn btn-default">Geri</a>
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
    $('.select2').select2();
    $('.date').datepicker({
        format: 'dd/mm/yyyy',
        language: 'tr',
        autoclose: true
    });
    $('input[type="radio"]').iCheck({
        radioClass: 'icheckbox_square-blue'
    }); 

    $('#add-area-inputs').click(function(e) {
        e.preventDefault();

        $('#listing-area').empty();

        var areaCount = $('#area_count')[0].value;
        if(isNaN(areaCount)) 
            $('#budget')[0].value = $('#budget')[0].value*areaCount;        
        
        for (let i = 1; i <= areaCount; i++) {
        $('#listing-area').append(`
                <div class="form-group">
                    <label for="counts" class="col-sm-2 control-label">Sera - ${i}</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="area_names[]" placeholder="Saha Adı">
                    </div>
                </div>  
            `);            
        }
        $('.select2').select2();
    });
    
</script>
@endpush 