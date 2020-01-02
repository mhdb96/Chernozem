@extends('layouts.partial.edit.form')

{{-- @extends('layouts.partial.container')
@section('content-title', $title.' Türleri')
@section('content-description', $data->name.' Güncelle')

@section('content')
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">

          <div class="box-header with-border">
            <h3 class="box-title">{{ $data->name }} Güncelle</h3>
          </div>

          <form class="form-horizontal" action="{{ route($route.'.update', $data->id) }}" method="POST">
            @method('PUT')
            @csrf


{{$fillable=$fillables[2]}}

<div class="box-body">
    <label for="{{$fillable}}" class="col-sm-2 control-label">{{$fillables_titles[2]}}</label>
    <div class="col-sm-8">
        <input type="text" class="form-control" name={{$fillable}} id={{$fillable}} placeholder="{{$fillables_titles[2]}} Giriniz" value="{{ $data->$fillable}}" required>
    </div>
</div>



            <div class="box-footer">
                <a href="{{ route($route.'.index') }}" class="btn btn-default">Geri</a>
                <button type="submit" class="btn btn-primary pull-right">Güncelle</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</section>

<div class="modal fade" id="showDeleteMessage">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">UYARI</h4>
      </div>
      <div class="modal-body">
          <p>Bu bilgiyi silemezsiniz.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Tamam</button>
      </div>
    </div>
  </div>
</div>

@endsection
@push('scripts')
<script>
  $(document).ready(function() {
    $('.select2').select2();
  });
</script>
@endpush --}}
