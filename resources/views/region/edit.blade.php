@extends('layouts.master')

@section('title', 'İklim Türleri')

@section('content-title', 'İklim Türleri')
@section('content-description', $region->name.' Güncelle')
@section('breadcrumb-title', 'İklim Türleri')

@section('content')
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">

          <div class="box-header with-border">
            <h3 class="box-title">{{ $region->name }} Güncelle</h3>
          </div>

          <form class="form-horizontal" action="{{ route('region.update', $region->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Ad</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" id="name" placeholder="İklim Türü Adı" value="{{ $region->name }}">
                    </div>
                </div>  

                <div class="form-group">
                  <label for="soils" class="col-sm-2 control-label">Toprak Türleri</label>
                  <div class="col-sm-8">
                    <select class="form-control select2" multiple="multiple" name="soils[]" data-placeholder="Toprak Türlerini Seçin" style="width: 100%;">
                      @foreach ($soils as $item)
                        <option value="{{ $item->id }}" {{ in_array($item->id, $insertedSoilIds) ? 'selected' : '' }}>{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

            </div>

            <div class="box-footer">
                <a href="{{ route('region.index') }}" class="btn btn-default">Geri</a>
                <button type="submit" class="btn btn-primary pull-right">Kaydet</button>
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
  });
</script>
@endpush