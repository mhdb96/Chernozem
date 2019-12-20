
@extends('layouts.partial.container')
@section('content-title', $title.' Türleri')
@section('content-description', 'Yeni '.$title.' Türleri Ekle')

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Yeni {{$title}} Türleri Ekle</h3>
        </div>
        <form class="form-horizontal" action="{{ route($route.'.store') }}" method="POST">
          @csrf

          @include('layouts.partial.create.form-content')

          <div class="box-footer">
            <a href="{{ route($route.'.index') }}" class="btn btn-default">Geri</a>
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
      $("#add-button").click(function(){
        $(".box-body").append(`@include('layouts.partial.create.dynamic')`);
      });

      $('.select2').select2();

      $("#box-body").on("click", ".remove-button", function(){
        var t = $(this).offsetParent();
        t = t.offsetParent();
        t.remove();
        });
      });
  </script>
@endpush
