@extends('layouts.partial.container')
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

            @include('layouts.partial.edit.form-content')

            <div class="box-footer">
                <a href="{{ route($route.'.index') }}" class="btn btn-default">Geri</a>
                <button type="submit" class="btn btn-primary pull-right">Güncelle</button>
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
