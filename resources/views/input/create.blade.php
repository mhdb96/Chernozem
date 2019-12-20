@extends('layouts.master')

@section('title', 'Giriş Türleri')

@section('content-title', 'Giriş Türleri')
@section('content-description', 'Yeni Giriş Türleri Ekle')
@section('breadcrumb-title', 'Giriş Türleri')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box-header with-border">
          <h3 class="box-title">Yeni Giriş Türleri Ekle</h3>
        </div>

        <form class="form-horizontal" action="{{ route('input.store') }}" method="POST">
          @csrf
          <div class="box-body">

            <div class="col-sm-12 input-box" id="group_1">
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Ad</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="name[]" id="name" placeholder="Giriş Türü Adı">
                </div>
              </div>

              <div class="form-group">
                <label for="fertility" class="col-sm-2 control-label">Verimlilik</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="fertility[]" id="fertility" placeholder="Giriş Verimliliği">
                </div>

                <div class="col-sm-2">
                  <button type="button" class="btn btn-block btn-success" style="margin-top: -25px" id="add-button">
                    <i class="fa fa-plus"></i> Ekle
                  </button>
                </div>
              </div>

            </div>

          </div>

          <div class="box-footer">
            <a href="{{ route('soil.index') }}" class="btn btn-default">Geri</a>
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

    $(document).ready(function(){

      // Add new element
      $("#add-button").click(function(){

        // Finding total number of elements added
        var total_element = $(".input-box").length;

        // last <div> with element class id
        var lastid = $(".input-box:last").attr("id");
        var split_id = lastid.split("_");
        var nextindex = Number(split_id[1]) + 1;

        var max = 5;
        // Check total number elements
        if(total_element < max ){
          // Adding new div container after last occurance of element class
          $(".input-box:last").after("<div class='col-sm-12 input-box' id='group_"+ nextindex +"'></div>");

          // Adding element to <div>
          $("#group_" + nextindex).append(`
            <hr>
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Ad</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="name[]" id="name" placeholder="Giriş Türü Adı">
              </div>
            </div>

            <div class="form-group">
              <label for="fertility" class="col-sm-2 control-label">Verimlilik</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="fertility[]" id="fertility" placeholder="Giriş Verimliliği">
              </div>
              <div class="col-sm-2">
                <button type="button" class="btn btn-block btn-danger remove-button" style="margin-top: -25px" id="remove_${nextindex}">
                  <i class="fa fa-trash"></i> Kaldır
                </button>
              </div>
            </div>
          `);
        }
      });

      $('.box-body').on('click', '.remove-button', function(){
        var id = this.id;
        var split_id = id.split("_");
        var deleteindex = split_id[1];

        // Remove <div> with id
        $("#group_" + deleteindex).remove();

      });
    });

  </script>
@endpush
